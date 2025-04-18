// Project 011: Simple Number Guessing Game CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const secret = Math.floor(Math.random() * 10) + 1;
rl.question('Guess a number between 1 and 10: ', (guess) => {
    const n = Number(guess);
    if (n === secret) {
        console.log('Correct!');
    } else {
        console.log(`Wrong! The number was ${secret}`);
    }
    rl.close();
});
