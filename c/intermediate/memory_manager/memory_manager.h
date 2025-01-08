#ifndef MEMORY_MANAGER_H
#define MEMORY_MANAGER_H

#include <stddef.h>
#include <stdbool.h>

// Memory block structure
typedef struct mem_block {
    size_t size;           // Size of the block
    bool is_free;          // Whether the block is free
    struct mem_block *next;// Next block in the list
    struct mem_block *prev;// Previous block in the list
    void *data;           // Pointer to the actual data
} mem_block_t;

// Memory manager functions
bool mm_init(size_t pool_size);
void *mm_alloc(size_t size);
bool mm_free(void *ptr);
bool mm_defragment(void);
void mm_cleanup(void);

// Diagnostic functions
void mm_show_map(void);
void mm_show_stats(void);
void mm_diagnostics(void);

// Memory statistics structure
typedef struct {
    size_t total_size;
    size_t used_size;
    size_t free_size;
    size_t largest_free_block;
    size_t num_blocks;
    size_t num_free_blocks;
    double fragmentation;
} mm_stats_t;

#endif 