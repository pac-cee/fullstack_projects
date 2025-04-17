use std::env;
use std::fs;

fn main() {
    let args: Vec<String> = env::args().collect();
    let path = if args.len() > 1 { &args[1] } else { "." };
    match fs::read_dir(path) {
        Ok(entries) => {
            for entry in entries {
                let entry = entry.unwrap();
                println!("{}", entry.path().display());
            }
        },
        Err(e) => println!("Error: {}", e),
    }
}
