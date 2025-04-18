// Project 006: User Input Echo CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter something: ', (answer) => {
    console.log(`You entered: ${answer}`);
    rl.close();
});
