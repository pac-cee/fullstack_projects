use std::env;

fn main() {
    let args: Vec<String> = env::args().collect();
    if args.len() == 3 && args[1] == "greet" {
        println!("Hello, {}!", args[2]);
    } else {
        println!("Usage: greet <name>");
    }
}
