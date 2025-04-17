use std::env;
use std::fs;

fn main() {
    let args: Vec<String> = env::args().collect();
    if args.len() != 3 {
        println!("Usage: <old_filename> <new_filename>");
        return;
    }
    match fs::rename(&args[1], &args[2]) {
        Ok(_) => println!("Renamed '{}' to '{}'", args[1], args[2]),
        Err(e) => println!("Error: {}", e),
    }
}
