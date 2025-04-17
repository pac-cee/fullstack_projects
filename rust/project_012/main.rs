use std::io;

fn main() {
    println!("Enter a string to reverse:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    let s = input.trim();
    let reversed: String = s.chars().rev().collect();
    println!("Reversed: {}", reversed);
}
