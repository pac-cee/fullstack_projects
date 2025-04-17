use std::io;
use std::time::Instant;

fn main() {
    println!("Press Enter to start the stopwatch...");
    let mut dummy = String::new();
    io::stdin().read_line(&mut dummy).unwrap();
    let start = Instant::now();
    println!("Press Enter to stop the stopwatch...");
    io::stdin().read_line(&mut dummy).unwrap();
    let duration = start.elapsed();
    println!("Elapsed: {:.2?}", duration);
}
