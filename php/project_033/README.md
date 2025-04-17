# Project 033: CSRF Protection

## Description
Add a CSRF token to a form and verify it on submit.

## Learning Goals
- Generate/store tokens in session
- Secure form handling

## Code
See [index.php](index.php)

## Logic & Explanation
We generate a token, store in session, add to form as hidden field, and verify on POST.
