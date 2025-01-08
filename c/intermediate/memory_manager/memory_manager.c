#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "memory_manager.h"
#include "debug.h"

static void *memory_pool = NULL;
static mem_block_t *head = NULL;
static size_t pool_size = 0;

bool mm_init(size_t size) {
    if (memory_pool) {
        debug_print("Memory manager already initialized\n");
        return false;
    }

    // Allocate memory pool
    memory_pool = malloc(size);
    if (!memory_pool) {
        debug_print("Failed to allocate memory pool\n");
        return false;
    }

    // Initialize first block
    head = (mem_block_t *)memory_pool;
    head->size = size - sizeof(mem_block_t);
    head->is_free = true;
    head->next = NULL;
    head->prev = NULL;
    head->data = (void *)((char *)memory_pool + sizeof(mem_block_t));

    pool_size = size;
    debug_print("Memory manager initialized with %zu bytes\n", size);
    return true;
}

void *mm_alloc(size_t size) {
    if (!memory_pool || !head) {
        debug_print("Memory manager not initialized\n");
        return NULL;
    }

    // Align size to 8 bytes
    size = (size + 7) & ~7;

    mem_block_t *current = head;
    while (current) {
        if (current->is_free && current->size >= size) {
            // Split block if it's too large
            if (current->size > size + sizeof(mem_block_t) + 8) {
                mem_block_t *new_block = (mem_block_t *)((char *)current->data + size);
                new_block->size = current->size - size - sizeof(mem_block_t);
                new_block->is_free = true;
                new_block->next = current->next;
                new_block->prev = current;
                new_block->data = (void *)((char *)new_block + sizeof(mem_block_t));

                current->size = size;
                current->next = new_block;
            }

            current->is_free = false;
            debug_print("Allocated %zu bytes at %p\n", size, current->data);
            return current->data;
        }
        current = current->next;
    }

    debug_print("Failed to allocate %zu bytes\n", size);
    return NULL;
}

bool mm_free(void *ptr) {
    if (!memory_pool || !ptr) {
        debug_print("Invalid pointer or memory manager not initialized\n");
        return false;
    }

    mem_block_t *current = head;
    while (current) {
        if (current->data == ptr) {
            if (current->is_free) {
                debug_print("Double free detected at %p\n", ptr);
                return false;
            }
            current->is_free = true;
            debug_print("Freed memory at %p\n", ptr);
            return true;
        }
        current = current->next;
    }

    debug_print("Invalid pointer %p\n", ptr);
    return false;
}

bool mm_defragment(void) {
    if (!memory_pool || !head) {
        debug_print("Memory manager not initialized\n");
        return false;
    }

    bool defragmented = false;
    mem_block_t *current = head;

    while (current && current->next) {
        if (current->is_free && current->next->is_free) {
            // Merge blocks
            current->size += current->next->size + sizeof(mem_block_t);
            current->next = current->next->next;
            if (current->next) {
                current->next->prev = current;
            }
            defragmented = true;
            continue;
        }
        current = current->next;
    }

    debug_print("Memory defragmentation %s\n", defragmented ? "performed" : "not needed");
    return true;
}

void mm_show_map(void) {
    if (!memory_pool || !head) {
        printf("Memory manager not initialized\n");
        return;
    }

    printf("\nMemory Map:\n");
    printf("%-20s %-10s %-10s %-10s\n", "Address", "Size", "Status", "Data Addr");
    printf("--------------------------------------------------------\n");

    mem_block_t *current = head;
    while (current) {
        printf("%-20p %-10zu %-10s %-10p\n",
               (void *)current,
               current->size,
               current->is_free ? "Free" : "Used",
               current->data);
        current = current->next;
    }
}

void mm_show_stats(void) {
    if (!memory_pool || !head) {
        printf("Memory manager not initialized\n");
        return;
    }

    mm_stats_t stats = {0};
    stats.total_size = pool_size;

    mem_block_t *current = head;
    while (current) {
        stats.num_blocks++;
        if (current->is_free) {
            stats.num_free_blocks++;
            stats.free_size += current->size;
            if (current->size > stats.largest_free_block) {
                stats.largest_free_block = current->size;
            }
        } else {
            stats.used_size += current->size;
        }
        current = current->next;
    }

    stats.fragmentation = (double)stats.num_free_blocks / stats.num_blocks;

    printf("\nMemory Statistics:\n");
    printf("Total Size: %zu bytes\n", stats.total_size);
    printf("Used Size: %zu bytes\n", stats.used_size);
    printf("Free Size: %zu bytes\n", stats.free_size);
    printf("Largest Free Block: %zu bytes\n", stats.largest_free_block);
    printf("Number of Blocks: %zu\n", stats.num_blocks);
    printf("Number of Free Blocks: %zu\n", stats.num_free_blocks);
    printf("Fragmentation: %.2f%%\n", stats.fragmentation * 100);
}

void mm_cleanup(void) {
    if (memory_pool) {
        free(memory_pool);
        memory_pool = NULL;
        head = NULL;
        pool_size = 0;
        debug_print("Memory manager cleaned up\n");
    }
} 