// Project 012: Fahrenheit to Celsius Converter CLI
import * as readline from 'readline';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('Enter temperature in Fahrenheit: ', (f) => {
    const fahrenheit = Number(f);
    if (isNaN(fahrenheit)) {
        console.log('Invalid input.');
    } else {
        const celsius = ((fahrenheit - 32) * 5) / 9;
        console.log(`${fahrenheit}°F = ${celsius.toFixed(2)}°C`);
    }
    rl.close();
});
