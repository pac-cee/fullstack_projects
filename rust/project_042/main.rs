use std::fs::File;
use std::io::{self, BufRead};

fn main() {
    let file = File::open("input.txt");
    match file {
        Ok(f) => {
            for line in io::BufReader::new(f).lines() {
                println!("{}", line.unwrap());
            }
        },
        Err(e) => println!("Error: {}", e),
    }
}
