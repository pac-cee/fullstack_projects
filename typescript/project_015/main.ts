// Project 015: Simple Random Number Generator CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter min value: ', (minVal) => {
    rl.question('Enter max value: ', (maxVal) => {
        const min = Number(minVal);
        const max = Number(maxVal);
        if (isNaN(min) || isNaN(max) || min > max) {
            console.log('Invalid input.');
        } else {
            const rand = Math.floor(Math.random() * (max - min + 1)) + min;
            console.log(`Random number: ${rand}`);
        }
        rl.close();
    });
});
