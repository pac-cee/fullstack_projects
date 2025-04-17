use std::io;

fn main() {
    println!("Enter a word to check for palindrome:");
    let mut input = String::new();
    io::stdin().read_line(&mut input).expect("Failed to read");
    let s = input.trim();
    let is_palindrome = s.chars().eq(s.chars().rev());
    println!("{} is {}a palindrome.", s, if is_palindrome { "" } else { "not " });
}
