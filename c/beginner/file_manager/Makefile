CC = gcc
CFLAGS = -Wall -Wextra -g
SRCS = main.c file_operations.c utils.c
OBJS = $(SRCS:.c=.o)
TARGET = file_manager

.PHONY: all clean

all: $(TARGET)

$(TARGET): $(OBJS)
	$(CC) $(OBJS) -o $(TARGET)

%.o: %.c
	$(CC) $(CFLAGS) -c $< -o $@

clean:
	rm -f $(OBJS) $(TARGET) 