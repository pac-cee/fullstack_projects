# Project 060: Background Jobs

## Description
Queue system with Redis to run background jobs.

## Learning Goals
- Use Redis for job queues
- Separate worker script to process jobs

## Code
See [enqueue.php](enqueue.php) and [worker.php](worker.php)

## Logic & Explanation
Enqueue jobs into Redis, have a worker script that pulls and processes jobs asynchronously.
