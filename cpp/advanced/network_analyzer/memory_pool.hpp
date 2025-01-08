#pragma once

#include <vector>
#include <mutex>
#include <memory>
#include <type_traits>

/**
 * @class MemoryPool
 * @brief Custom memory pool implementation for efficient packet storage
 * 
 * Features:
 * - Fixed-size block allocation
 * - Thread-safe operations
 * - Memory alignment support
 * - RAII-compliant
 */
template<typename T, size_t BlockSize = 4096>
class MemoryPool {
    static_assert(std::is_trivially_copyable_v<T>,
                 "Type must be trivially copyable");

public:
    MemoryPool(size_t initialSize = 1024)
        : blockSize_(BlockSize)
        , freeList_(nullptr) {
        allocateBlock();
    }

    ~MemoryPool() {
        for (auto block : blocks_) {
            ::operator delete(block);
        }
    }

    // Allocate memory from pool
    T* allocate() {
        std::lock_guard<std::mutex> lock(mutex_);
        
        if (!freeList_) {
            allocateBlock();
        }

        T* result = freeList_;
        freeList_ = *reinterpret_cast<T**>(freeList_);
        return result;
    }

    // Return memory to pool
    void deallocate(T* ptr) {
        std::lock_guard<std::mutex> lock(mutex_);
        
        *reinterpret_cast<T**>(ptr) = freeList_;
        freeList_ = ptr;
    }

private:
    void allocateBlock() {
        // Allocate new block with proper alignment
        void* block = ::operator new(blockSize_);
        blocks_.push_back(block);

        // Initialize free list
        char* start = static_cast<char*>(block);
        size_t elementSize = sizeof(T);
        size_t elements = blockSize_ / elementSize;

        for (size_t i = 0; i < elements - 1; ++i) {
            T* current = reinterpret_cast<T*>(start + i * elementSize);
            T* next = reinterpret_cast<T*>(start + (i + 1) * elementSize);
            *reinterpret_cast<T**>(current) = next;
        }

        // Set last element
        T* last = reinterpret_cast<T*>(start + (elements - 1) * elementSize);
        *reinterpret_cast<T**>(last) = freeList_;
        freeList_ = reinterpret_cast<T*>(start);
    }

private:
    const size_t blockSize_;
    T* freeList_;
    std::vector<void*> blocks_;
    std::mutex mutex_;
}; 