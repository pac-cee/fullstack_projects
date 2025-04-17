use std::io;
use std::fs;

fn main() {
    println!("Enter text to write to output.txt:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).unwrap();
    fs::write("output.txt", input).unwrap();
    println!("Written to output.txt");
}
