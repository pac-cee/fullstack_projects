use std::io;

fn main() {
    println!("Enter first string:");
    let mut s1 = String::new();
    io::stdin().read_line(&mut s1).unwrap();
    println!("Enter second string:");
    let mut s2 = String::new();
    io::stdin().read_line(&mut s2).unwrap();
    let result = s1.trim().to_string() + s2.trim();
    println!("Concatenated: {}", result);
}
