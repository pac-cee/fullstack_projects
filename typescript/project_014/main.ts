// Project 014: Simple Factorial Calculator CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter a number: ', (num) => {
    const n = Number(num);
    if (isNaN(n) || n < 0) {
        console.log('Invalid input.');
    } else {
        let fact = 1;
        for (let i = 2; i <= n; i++) {
            fact *= i;
        }
        console.log(`Factorial: ${fact}`);
    }
    rl.close();
});
