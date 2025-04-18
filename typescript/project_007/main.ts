// Project 007: Simple Adder CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter first number: ', (a) => {
    rl.question('Enter second number: ', (b) => {
        const sum = Number(a) + Number(b);
        console.log(`Sum: ${sum}`);
        rl.close();
    });
});
