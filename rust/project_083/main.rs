use std::env;
use std::fs;
use std::io::{self, Read, Write};

fn xor_file(input: &str, output: &str, key: u8) -> io::Result<()> {
    let mut data = fs::read(input)?;
    for byte in &mut data {
        *byte ^= key;
    }
    fs::write(output, data)?;
    Ok(())
}

fn main() {
    let args: Vec<String> = env::args().collect();
    if args.len() != 5 {
        println!("Usage: encrypt <input> <output> <key> | decrypt <input> <output> <key>");
        return;
    }
    let key = args[4].parse::<u8>().unwrap();
    match args[1].as_str() {
        "encrypt" | "decrypt" => {
            if let Err(e) = xor_file(&args[2], &args[3], key) {
                println!("Error: {}", e);
            } else {
                println!("Done!");
            }
        },
        _ => println!("Unknown command"),
    }
}
