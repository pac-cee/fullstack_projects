use std::io;
use rand::Rng;

fn main() {
    let secret = rand::thread_rng().gen_range(1..=100);
    println!("Guess the number (1-100)!");
    loop {
        let mut guess = String::new();
        io::stdin().read_line(&mut guess).expect("Failed to read line");
        let guess: u32 = match guess.trim().parse() {
            Ok(num) => num,
            Err(_) => continue,
        };
        if guess < secret {
            println!("Too low!");
        } else if guess > secret {
            println!("Too high!");
        } else {
            println!("You win! The number was {}.", secret);
            break;
        }
    }
}
