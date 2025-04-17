# Project 018: Cookie Counter

## Description
Count visits using cookies.

## Learning Goals
- Set and read cookies
- Increment cookie value
- Handle headers before output

## Code
See [index.php](index.php)

## Logic & Explanation
We check for a `visits` cookie. If set, increment its value; otherwise start at 1. Use `setcookie()` before any output, then echo the count.
