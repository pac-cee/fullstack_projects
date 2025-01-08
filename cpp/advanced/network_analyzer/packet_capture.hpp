#pragma once

#include <pcap.h>
#include <array>
#include <vector>
#include <memory>
#include <atomic>
#include <queue>
#include <mutex>
#include <condition_variable>
#include "packet.hpp"
#include "memory_pool.hpp"

/**
 * @class PacketCapture
 * @brief Handles network packet capture using libpcap
 * 
 * Features:
 * - Zero-copy packet processing
 * - Custom memory pool for packet storage
 * - Lock-free queue for packet processing
 * - BPF filter support
 */
class PacketCapture {
public:
    explicit PacketCapture(const Config& config);
    ~PacketCapture();

    // Delete copy constructor and assignment
    PacketCapture(const PacketCapture&) = delete;
    PacketCapture& operator=(const PacketCapture&) = delete;

    void startCapture();
    void stopCapture();
    std::shared_ptr<Packet> getNextPacket();
    bool hasPackets() const;

private:
    static void packetCallback(u_char* user, 
                             const struct pcap_pkthdr* pkthdr,
                             const u_char* packet);
    
    void processPacket(const struct pcap_pkthdr* pkthdr, const u_char* packet);
    bool initializeDevice();
    void setupFilter(const std::string& filterExpr);

private:
    pcap_t* handle_;
    std::string deviceName_;
    std::string filterExpr_;
    std::atomic<bool> isRunning_;
    
    // Custom memory pool for packet storage
    MemoryPool<Packet> packetPool_;
    
    // Lock-free packet queue
    mutable std::mutex queueMutex_;
    std::condition_variable queueCV_;
    std::queue<std::shared_ptr<Packet>> packetQueue_;
    
    // Statistics
    std::atomic<uint64_t> packetsProcessed_;
    std::atomic<uint64_t> bytesProcessed_;
}; 