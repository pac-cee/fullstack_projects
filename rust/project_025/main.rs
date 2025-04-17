use std::fs::{OpenOptions, read_to_string};
use std::io::{self, Write};

fn main() {
    let mut file = OpenOptions::new().append(true).create(true).open("output.txt").unwrap();
    writeln!(file, "Appended line.").unwrap();
    let contents = read_to_string("output.txt").unwrap();
    println!("File contents:\n{}", contents);
}
