// Project 009: Simple Age Calculator CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter your birth year: ', (year) => {
    const birthYear = Number(year);
    const currentYear = new Date().getFullYear();
    if (isNaN(birthYear) || birthYear > currentYear) {
        console.log('Invalid year.');
    } else {
        console.log(`Your age is ${currentYear - birthYear}`);
    }
    rl.close();
});
