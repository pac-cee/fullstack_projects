use std::io;

fn main() {
    println!("Enter operation (e.g., 5 + 3):");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    let parts: Vec<&str> = input.trim().split_whitespace().collect();
    if parts.len() != 3 { println!("Invalid input"); return; }
    let a: f64 = match parts[0].parse() { Ok(v) => v, Err(_) => { println!("Invalid number"); return; } };
    let b: f64 = match parts[2].parse() { Ok(v) => v, Err(_) => { println!("Invalid number"); return; } };
    let result = match parts[1] {
        "+" => a + b,
        "-" => a - b,
        "*" => a * b,
        "/" => a / b,
        _ => { println!("Unknown operator"); return; }
    };
    println!("Result: {}", result);
}
