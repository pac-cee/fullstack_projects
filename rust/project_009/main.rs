use std::io;

fn main() {
    println!("Enter a number for its multiplication table:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    let n: u32 = match input.trim().parse() { Ok(v) => v, Err(_) => { println!("Invalid number"); return; } };
    for i in 1..=10 {
        println!("{} x {} = {}", n, i, n*i);
    }
}
