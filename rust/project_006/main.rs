use std::io;

fn c_to_f(c: f64) -> f64 { c * 9.0 / 5.0 + 32.0 }
fn f_to_c(f: f64) -> f64 { (f - 32.0) * 5.0 / 9.0 }

fn main() {
    println!("Convert temperature: Enter value and unit (e.g., 100 C or 212 F)");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    let parts: Vec<&str> = input.trim().split_whitespace().collect();
    if parts.len() != 2 { println!("Invalid input"); return; }
    let val: f64 = match parts[0].parse() { Ok(v) => v, Err(_) => { println!("Invalid number"); return; } };
    match parts[1].to_uppercase().as_str() {
        "C" => println!("{} C = {:.2} F", val, c_to_f(val)),
        "F" => println!("{} F = {:.2} C", val, f_to_c(val)),
        _ => println!("Unknown unit"),
    }
}
