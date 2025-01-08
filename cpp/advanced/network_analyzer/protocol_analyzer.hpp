#pragma once

#include <unordered_map>
#include <memory>
#include <variant>
#include <type_traits>
#include "packet.hpp"
#include "protocols.hpp"

/**
 * @class ProtocolAnalyzer
 * @brief Analyzes network protocols using template metaprogramming
 * 
 * Features:
 * - Protocol detection using type traits
 * - Variant-based protocol handling
 * - Compile-time protocol validation
 * - Statistical analysis
 */
class ProtocolAnalyzer {
public:
    ProtocolAnalyzer();
    
    void startAnalysis(std::shared_ptr<PacketCapture> capture);
    void stopAnalysis();
    
    // Template method for protocol analysis
    template<typename Protocol>
    std::enable_if_t<is_protocol_v<Protocol>, AnalysisResult>
    analyzeProtocol(const Packet& packet);
    
    // Get protocol statistics
    template<typename Protocol>
    const ProtocolStats& getStats() const;

private:
    // Helper to detect protocol type at compile time
    template<typename T>
    using protocol_variant = std::variant<
        std::monostate,
        TCP,
        UDP,
        ICMP,
        HTTP,
        DNS,
        TLS
    >;

    // Protocol handlers
    std::unordered_map<
        ProtocolType,
        std::function<void(const Packet&)>
    > protocolHandlers_;

    // Protocol statistics
    std::unordered_map<ProtocolType, ProtocolStats> stats_;
    
    // Thread synchronization
    std::atomic<bool> isRunning_;
    mutable std::shared_mutex statsMutex_;
};

// Template implementation
template<typename Protocol>
std::enable_if_t<is_protocol_v<Protocol>, AnalysisResult>
ProtocolAnalyzer::analyzeProtocol(const Packet& packet) {
    AnalysisResult result;
    
    if constexpr (std::is_same_v<Protocol, TCP>) {
        result = analyzeTCP(packet);
    } else if constexpr (std::is_same_v<Protocol, UDP>) {
        result = analyzeUDP(packet);
    } else if constexpr (std::is_same_v<Protocol, HTTP>) {
        result = analyzeHTTP(packet);
    } // ... other protocols

    return result;
} 