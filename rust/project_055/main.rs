use std::{thread, time};
use std::io;

fn main() {
    println!("Enter seconds to wait:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).unwrap();
    let secs: u64 = input.trim().parse().unwrap();
    println!("Waiting...");
    thread::sleep(time::Duration::from_secs(secs));
    println!("Time's up!");
}
