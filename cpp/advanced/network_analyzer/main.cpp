/**
 * Network Protocol Analyzer
 * Advanced C++ project demonstrating:
 * - Network Programming
 * - Multi-threading
 * - Design Patterns
 * - Advanced STL Usage
 * - Custom Memory Management
 * - Template Metaprogramming
 * - Modern C++ Features (C++17/20)
 */

#include <iostream>
#include <memory>
#include <thread>
#include "packet_capture.hpp"
#include "protocol_analyzer.hpp"
#include "user_interface.hpp"
#include "logger.hpp"

int main(int argc, char* argv[]) {
    try {
        // Initialize logger with singleton pattern
        Logger::getInstance().setLogLevel(LogLevel::INFO);
        LOG_INFO("Starting Network Protocol Analyzer...");

        // Parse command line arguments
        ConfigManager config(argc, argv);
        
        // Create packet capture engine
        auto captureEngine = std::make_shared<PacketCapture>(config);
        
        // Create protocol analyzer
        auto analyzer = std::make_shared<ProtocolAnalyzer>();
        
        // Create user interface
        UserInterface ui(captureEngine, analyzer);

        // Start capture in separate thread
        std::thread captureThread([&captureEngine]() {
            captureEngine->startCapture();
        });

        // Start analysis in separate thread
        std::thread analysisThread([&analyzer, &captureEngine]() {
            analyzer->startAnalysis(captureEngine);
        });

        // Run UI in main thread
        ui.run();

        // Cleanup
        captureEngine->stopCapture();
        captureThread.join();
        analysisThread.join();

        LOG_INFO("Network Protocol Analyzer shutdown complete");
        return 0;

    } catch (const std::exception& e) {
        LOG_ERROR("Fatal error: {}", e.what());
        return 1;
    }
} 