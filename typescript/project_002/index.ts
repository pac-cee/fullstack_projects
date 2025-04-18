import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

console.log("Project 2: User Input (TypeScript)");
rl.question('Please enter your name: ', (name) => {
    console.log(`Hello, ${name}!`);
    rl.close();
});
