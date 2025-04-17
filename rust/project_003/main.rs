fn fibonacci(n: u32) -> u32 {
    match n {
        0 => 0,
        1 => 1,
        _ => fibonacci(n-1) + fibonacci(n-2),
    }
}

fn main() {
    println!("Project 3: Fibonacci Sequence (Rust)");
    for i in 0..10 {
        println!("Fibonacci({}) = {}", i, fibonacci(i));
    }
}
