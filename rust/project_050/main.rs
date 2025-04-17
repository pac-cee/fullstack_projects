use rand::{thread_rng, Rng};
use rand::distributions::Alphanumeric;
use std::io;

fn main() {
    println!("Enter password length:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).unwrap();
    let len: usize = input.trim().parse().unwrap();
    let password: String = thread_rng()
        .sample_iter(&Alphanumeric)
        .take(len)
        .map(char::from)
        .collect();
    println!("Generated password: {}", password);
}
