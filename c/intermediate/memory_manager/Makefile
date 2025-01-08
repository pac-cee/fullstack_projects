CC = gcc
CFLAGS = -Wall -Wextra -g -DDEBUG
SRCS = main.c memory_manager.c
OBJS = $(SRCS:.c=.o)
TARGET = memory_manager

.PHONY: all clean test

all: $(TARGET)

$(TARGET): $(OBJS)
	$(CC) $(OBJS) -o $(TARGET)

%.o: %.c
	$(CC) $(CFLAGS) -c $< -o $@

test: $(TARGET)
	./test_memory_manager

clean:
	rm -f $(OBJS) $(TARGET) 