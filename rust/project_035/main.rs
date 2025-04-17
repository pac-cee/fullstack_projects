fn largest<T: PartialOrd + Copy>(a: T, b: T) -> T {
    if a > b { a } else { b }
}

fn main() {
    println!("Largest: {}", largest(10, 20));
    println!("Largest: {}", largest(3.5, 2.1));
}
