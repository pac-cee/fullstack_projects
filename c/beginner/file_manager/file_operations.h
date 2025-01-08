#ifndef FILE_OPERATIONS_H
#define FILE_OPERATIONS_H

void list_files(const char *path);
void create_file(const char *filename);
void read_file(const char *filename);
void write_file(const char *filename);
void delete_file(const char *filename);
void copy_file(const char *source, const char *dest);
void move_file(const char *source, const char *dest);
void file_info(const char *filename);

#endif 