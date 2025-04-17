fn take_ownership(s: String) {
    println!("Took ownership of: {}", s);
}

fn main() {
    let s = String::from("ownership!");
    take_ownership(s);
    // println!("{}", s); // This would not compile
}
