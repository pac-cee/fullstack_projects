use std::collections::HashMap;
use std::io;

fn main() {
    println!("Enter a sentence:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).unwrap();
    let mut counts = HashMap::new();
    for word in input.trim().split_whitespace() {
        *counts.entry(word).or_insert(0) += 1;
    }
    println!("Word counts: {:?}", counts);
}
