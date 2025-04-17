use std::io;

fn is_prime(n: u64) -> bool {
    if n <= 1 { return false; }
    for i in 2..=((n as f64).sqrt() as u64) {
        if n % i == 0 { return false; }
    }
    true
}

fn main() {
    println!("Enter a number to check if it's prime:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    let n: u64 = match input.trim().parse() { Ok(v) => v, Err(_) => { println!("Invalid number"); return; } };
    println!("{} is {}a prime number.", n, if is_prime(n) { "" } else { "not " });
}
