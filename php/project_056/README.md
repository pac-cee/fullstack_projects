# Project 056: Rate Limiter

## Description
Throttle requests per IP address.

## Learning Goals
- Track requests per IP
- Enforce limits with time windows

## Code
See [index.php](index.php)

## Logic & Explanation
Stores request timestamps in a file or memory, blocks requests exceeding the allowed rate.
