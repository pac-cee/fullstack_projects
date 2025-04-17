use std::io;

fn factorial(n: u64) -> u64 {
    if n == 0 { 1 } else { n * factorial(n - 1) }
}

fn main() {
    println!("Enter a number to calculate its factorial:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    let n: u64 = match input.trim().parse() { Ok(v) => v, Err(_) => { println!("Invalid number"); return; } };
    println!("{}! = {}", n, factorial(n));
}
