# Project 077: REST API Rate Limiter

## Description
Implement per-user or per-IP rate limiting middleware for APIs.

## Learning Goals
- Middleware pattern
- Store and check request counts

## Code
See [index.php](index.php)

## Logic & Explanation
Wraps API endpoints with rate limiting logic and returns 429 if exceeded.
