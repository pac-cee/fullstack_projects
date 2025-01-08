/**
 * Task Management System
 * A console-based application demonstrating core C++ concepts:
 * - Classes and Objects
 * - Inheritance
 * - Polymorphism
 * - File I/O
 * - STL Containers
 * - Exception Handling
 * - Smart Pointers
 */

#include <iostream>
#include <memory>
#include "task_manager.hpp"
#include "user_interface.hpp"

int main() {
    try {
        // Create TaskManager instance using smart pointer
        auto taskManager = std::make_unique<TaskManager>();
        
        // Create UserInterface instance
        UserInterface ui(taskManager.get());
        
        // Start the application
        ui.run();
        
    } catch (const std::exception& e) {
        std::cerr << "Fatal error: " << e.what() << std::endl;
        return 1;
    }
    
    return 0;
} 