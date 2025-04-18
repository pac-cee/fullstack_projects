// Project 008: Even or Odd Checker CLI
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
        console.log(n % 2 === 0 ? 'Even' : 'Odd');
    }
    rl.close();
});
