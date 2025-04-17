# Project 010: Form Handler

## Description
Build an HTML form and process user input in PHP.

## Learning Goals
- Create and handle forms
- Use `$_GET` or `$_POST`
- Sanitize basic input

## Code
See [index.php](index.php)

## Logic & Explanation
We render a simple HTML form. On submission to the same page, we check `$_POST['name']`, sanitize it, and echo a greeting.
