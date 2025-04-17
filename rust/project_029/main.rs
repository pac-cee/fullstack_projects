fn print_length(s: &String) {
    println!("Length: {}", s.len());
}

fn main() {
    let s = String::from("borrowing");
    print_length(&s);
    println!("String is still accessible: {}", s);
}
