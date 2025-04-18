// Project 010: Simple Multiplication Table CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter a number: ', (num) => {
    const n = Number(num);
    if (isNaN(n)) {
        console.log('Invalid input.');
    } else {
        for (let i = 1; i <= 10; i++) {
            console.log(`${n} x ${i} = ${n * i}`);
        }
    }
    rl.close();
});
