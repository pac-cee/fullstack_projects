use std::io;

fn main() {
    println!("Project 2: User Input (Rust)");
    println!("Please enter your name:");
    let mut name = String::new();
    io::stdin().read_line(&mut name).expect("Failed to read line");
    println!("Hello, {}!", name.trim());
}
