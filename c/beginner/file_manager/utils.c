#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "utils.h"

void clear_screen() {
    #ifdef _WIN32
        system("cls");
    #else
        system("clear");
    #endif
}

void print_error(const char *message) {
    fprintf(stderr, "\033[1;31mError: %s\033[0m\n", message);
}

int confirm_action(const char *message) {
    char response;
    printf("%s (y/n): ", message);
    scanf(" %c", &response);
    return (response == 'y' || response == 'Y');
} 