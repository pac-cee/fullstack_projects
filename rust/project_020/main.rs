use std::io;

fn main() {
    println!("Enter a number:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    match input.trim().parse::<i32>() {
        Ok(n) => println!("You entered: {}", n),
        Err(e) => println!("Error: {}", e),
    }
}
