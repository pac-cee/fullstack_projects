use std::fs;

fn main() {
    let contents = fs::read_to_string("input.txt");
    match contents {
        Ok(text) => println!("File contents:\n{}", text),
        Err(e) => println!("Error reading file: {}", e),
    }
}
