use std::env;

fn main() {
    let var = "HOME";
    match env::var(var) {
        Ok(val) => println!("{}: {}", var, val),
        Err(e) => println!("Couldn't read {}: {}", var, e),
    }
}
