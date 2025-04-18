// Project 013: Simple Palindrome Checker CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter a word: ', (word) => {
    const cleaned = word.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
    const isPalindrome = cleaned === cleaned.split('').reverse().join('');
    console.log(isPalindrome ? 'Palindrome' : 'Not a palindrome');
    rl.close();
});
