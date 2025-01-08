#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "memory_manager.h"
#include "debug.h"

#define POOL_SIZE (1024 * 1024) // 1MB memory pool

int main() {
    // Initialize memory manager
    if (!mm_init(POOL_SIZE)) {
        fprintf(stderr, "Failed to initialize memory manager\n");
        return 1;
    }

    printf("Memory Manager initialized with %d bytes\n", POOL_SIZE);
    
    while (1) {
        printf("\nMemory Manager Menu:\n");
        printf("1. Allocate memory\n");
        printf("2. Free memory\n");
        printf("3. Show memory map\n");
        printf("4. Show statistics\n");
        printf("5. Run diagnostics\n");
        printf("6. Defragment memory\n");
        printf("7. Exit\n");
        printf("Choice: ");

        int choice;
        scanf("%d", &choice);
        getchar(); // Clear newline

        switch (choice) {
            case 1: {
                size_t size;
                printf("Enter size to allocate (bytes): ");
                scanf("%zu", &choice);
                void *ptr = mm_alloc(size);
                if (ptr) {
                    printf("Allocated %zu bytes at address %p\n", size, ptr);
                } else {
                    printf("Failed to allocate memory\n");
                }
                break;
            }
            case 2: {
                void *ptr;
                printf("Enter address to free (hex): ");
                scanf("%p", &ptr);
                if (mm_free(ptr)) {
                    printf("Memory freed successfully\n");
                } else {
                    printf("Failed to free memory\n");
                }
                break;
            }
            case 3:
                mm_show_map();
                break;
            case 4:
                mm_show_stats();
                break;
            case 5:
                mm_diagnostics();
                break;
            case 6:
                if (mm_defragment()) {
                    printf("Memory defragmented successfully\n");
                } else {
                    printf("Defragmentation failed\n");
                }
                break;
            case 7:
                mm_cleanup();
                printf("Memory manager cleaned up. Exiting...\n");
                return 0;
            default:
                printf("Invalid choice\n");
        }
    }

    return 0;
} 