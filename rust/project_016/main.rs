use std::io;

fn main() {
    println!("Enter numbers separated by spaces:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    let mut numbers: Vec<i32> = input.trim().split_whitespace().filter_map(|s| s.parse().ok()).collect();
    numbers.sort();
    println!("Sorted: {:?}", numbers);
}
