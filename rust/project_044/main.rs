use std::env;

fn main() {
    let sum: i32 = env::args().skip(1).filter_map(|a| a.parse().ok()).sum();
    println!("Sum: {}", sum);
}
