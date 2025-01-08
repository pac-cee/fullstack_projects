#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <dirent.h>
#include <sys/stat.h>
#include <unistd.h>
#include <time.h>
#include "file_operations.h"
#include "utils.h"

#define BUFFER_SIZE 4096

void list_files(const char *path) {
    DIR *dir;
    struct dirent *entry;
    struct stat file_stat;
    char full_path[1024];

    dir = opendir(path);
    if (dir == NULL) {
        perror("Error opening directory");
        return;
    }

    printf("\nDirectory listing for %s:\n", path);
    printf("%-30s %-10s %-20s\n", "Name", "Size", "Last Modified");
    printf("----------------------------------------------------------------\n");

    while ((entry = readdir(dir)) != NULL) {
        snprintf(full_path, sizeof(full_path), "%s/%s", path, entry->d_name);
        
        if (stat(full_path, &file_stat) == -1) {
            perror("Error getting file status");
            continue;
        }

        char time_str[20];
        strftime(time_str, sizeof(time_str), "%Y-%m-%d %H:%M:%S", 
                localtime(&file_stat.st_mtime));

        printf("%-30s %-10ld %-20s\n", 
               entry->d_name, 
               file_stat.st_size, 
               time_str);
    }

    closedir(dir);
}

void create_file(const char *filename) {
    FILE *file = fopen(filename, "w");
    if (file == NULL) {
        perror("Error creating file");
        return;
    }
    printf("File created successfully: %s\n", filename);
    fclose(file);
}

void read_file(const char *filename) {
    FILE *file = fopen(filename, "r");
    if (file == NULL) {
        perror("Error opening file");
        return;
    }

    char buffer[BUFFER_SIZE];
    printf("\nContent of %s:\n", filename);
    printf("----------------------------------------------------------------\n");
    
    while (fgets(buffer, BUFFER_SIZE, file) != NULL) {
        printf("%s", buffer);
    }
    printf("\n----------------------------------------------------------------\n");

    fclose(file);
}

void write_file(const char *filename) {
    FILE *file = fopen(filename, "a");
    if (file == NULL) {
        perror("Error opening file");
        return;
    }

    printf("Enter text (Ctrl+D or Ctrl+Z to finish):\n");
    char buffer[BUFFER_SIZE];
    while (fgets(buffer, BUFFER_SIZE, stdin) != NULL) {
        fputs(buffer, file);
    }

    fclose(file);
    printf("Content written to file successfully\n");
}

void delete_file(const char *filename) {
    if (remove(filename) == 0) {
        printf("File deleted successfully: %s\n", filename);
    } else {
        perror("Error deleting file");
    }
}

void copy_file(const char *source, const char *dest) {
    FILE *src = fopen(source, "rb");
    if (src == NULL) {
        perror("Error opening source file");
        return;
    }

    FILE *dst = fopen(dest, "wb");
    if (dst == NULL) {
        perror("Error opening destination file");
        fclose(src);
        return;
    }

    char buffer[BUFFER_SIZE];
    size_t bytes_read;
    while ((bytes_read = fread(buffer, 1, BUFFER_SIZE, src)) > 0) {
        fwrite(buffer, 1, bytes_read, dst);
    }

    fclose(src);
    fclose(dst);
    printf("File copied successfully\n");
}

void move_file(const char *source, const char *dest) {
    if (rename(source, dest) == 0) {
        printf("File moved successfully\n");
    } else {
        perror("Error moving file");
    }
}

void file_info(const char *filename) {
    struct stat file_stat;
    
    if (stat(filename, &file_stat) == -1) {
        perror("Error getting file information");
        return;
    }

    printf("\nFile Information for: %s\n", filename);
    printf("----------------------------------------------------------------\n");
    printf("Size: %ld bytes\n", file_stat.st_size);
    printf("Permissions: %o\n", file_stat.st_mode & 0777);
    printf("Last access: %s", ctime(&file_stat.st_atime));
    printf("Last modification: %s", ctime(&file_stat.st_mtime));
    printf("Last status change: %s", ctime(&file_stat.st_ctime));
} 