#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <dirent.h>
#include <sys/stat.h>
#include <unistd.h>
#include "file_operations.h"
#include "utils.h"

#define MAX_PATH 1024
#define MAX_COMMAND 100

void print_menu() {
    printf("\nFile Management System\n");
    printf("1. List files in directory\n");
    printf("2. Create new file\n");
    printf("3. Read file content\n");
    printf("4. Write to file\n");
    printf("5. Delete file\n");
    printf("6. Copy file\n");
    printf("7. Move file\n");
    printf("8. File information\n");
    printf("9. Exit\n");
    printf("Enter your choice: ");
}

int main() {
    char current_path[MAX_PATH];
    char command[MAX_COMMAND];
    int choice;
    
    // Get current working directory
    if (getcwd(current_path, sizeof(current_path)) == NULL) {
        perror("Error getting current directory");
        return 1;
    }

    while (1) {
        print_menu();
        if (scanf("%d", &choice) != 1) {
            printf("Invalid input\n");
            while (getchar() != '\n'); // Clear input buffer
            continue;
        }
        while (getchar() != '\n'); // Clear input buffer

        switch (choice) {
            case 1:
                list_files(current_path);
                break;
            case 2: {
                char filename[MAX_PATH];
                printf("Enter filename to create: ");
                fgets(filename, MAX_PATH, stdin);
                filename[strcspn(filename, "\n")] = 0;
                create_file(filename);
                break;
            }
            case 3: {
                char filename[MAX_PATH];
                printf("Enter filename to read: ");
                fgets(filename, MAX_PATH, stdin);
                filename[strcspn(filename, "\n")] = 0;
                read_file(filename);
                break;
            }
            case 4: {
                char filename[MAX_PATH];
                printf("Enter filename to write: ");
                fgets(filename, MAX_PATH, stdin);
                filename[strcspn(filename, "\n")] = 0;
                write_file(filename);
                break;
            }
            case 5: {
                char filename[MAX_PATH];
                printf("Enter filename to delete: ");
                fgets(filename, MAX_PATH, stdin);
                filename[strcspn(filename, "\n")] = 0;
                delete_file(filename);
                break;
            }
            case 6: {
                char source[MAX_PATH], dest[MAX_PATH];
                printf("Enter source filename: ");
                fgets(source, MAX_PATH, stdin);
                source[strcspn(source, "\n")] = 0;
                printf("Enter destination filename: ");
                fgets(dest, MAX_PATH, stdin);
                dest[strcspn(dest, "\n")] = 0;
                copy_file(source, dest);
                break;
            }
            case 7: {
                char source[MAX_PATH], dest[MAX_PATH];
                printf("Enter source filename: ");
                fgets(source, MAX_PATH, stdin);
                source[strcspn(source, "\n")] = 0;
                printf("Enter destination filename: ");
                fgets(dest, MAX_PATH, stdin);
                dest[strcspn(dest, "\n")] = 0;
                move_file(source, dest);
                break;
            }
            case 8: {
                char filename[MAX_PATH];
                printf("Enter filename for information: ");
                fgets(filename, MAX_PATH, stdin);
                filename[strcspn(filename, "\n")] = 0;
                file_info(filename);
                break;
            }
            case 9:
                printf("Exiting...\n");
                return 0;
            default:
                printf("Invalid choice\n");
        }
    }

    return 0;
} 