# Project 093: Distributed Locking

## Description
Implement distributed locking using Redis for critical sections.

## Learning Goals
- Use Redis for locks
- Prevent race conditions in concurrent PHP scripts

## Code
See [index.php](index.php)

## Logic & Explanation
Acquires a Redis lock before running a critical section, releases after.
