use std::env;

fn main() {
    let args: Vec<String> = env::args().collect();
    if args.len() != 4 {
        println!("Usage: <num1> <op> <num2>");
        return;
    }
    let a: f64 = args[1].parse().unwrap();
    let b: f64 = args[3].parse().unwrap();
    let result = match args[2].as_str() {
        "+" => a + b,
        "-" => a - b,
        "*" => a * b,
        "/" => a / b,
        _ => { println!("Unknown operator"); return; }
    };
    println!("Result: {}", result);
}
