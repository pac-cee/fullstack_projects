# Project 042: Caching Layer

## Description
Cache API responses in files to avoid repeated requests.

## Learning Goals
- File-based caching
- Cache expiration logic

## Code
See [index.php](index.php)

## Logic & Explanation
Checks if a cache file exists and is fresh. If so, loads from cache. Otherwise, fetches from API and saves to cache.
