#ifndef DEBUG_H
#define DEBUG_H

#include <stdio.h>

#ifdef DEBUG
    #define debug_print(fmt, ...) \
        fprintf(stderr, "DEBUG: %s:%d:%s(): " fmt, \
                __FILE__, __LINE__, __func__, ##__VA_ARGS__)
#else
    #define debug_print(fmt, ...) ((void)0)
#endif

#endif 