use std::env;

fn main() {
    let args: Vec<String> = env::args().collect();
    if args.len() != 4 {
        println!("Usage: <value> <from_unit> <to_unit>");
        return;
    }
    let value: f64 = args[1].parse().unwrap();
    let from = args[2].as_str();
    let to = args[3].as_str();
    let result = match (from, to) {
        ("m", "ft") => value * 3.28084,
        ("ft", "m") => value / 3.28084,
        ("c", "f") => value * 9.0 / 5.0 + 32.0,
        ("f", "c") => (value - 32.0) * 5.0 / 9.0,
        _ => {
            println!("Unknown conversion");
            return;
        }
    };
    println!("{} {} = {:.2} {}", value, from, result, to);
}
