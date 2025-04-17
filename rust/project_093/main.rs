use std::io;
use std::time::{Duration, Instant};

fn main() {
    println!("Press Enter to start the stopwatch...");
    let mut input = String::new();
    io::stdin().read_line(&mut input).unwrap();
    let start = Instant::now();
    println!("Press Enter to stop the stopwatch...");
    input.clear();
    io::stdin().read_line(&mut input).unwrap();
    let elapsed = start.elapsed();
    println!("Elapsed time: {:.2?}", elapsed);
}
