mod greeter {
    pub fn greet(name: &str) {
        println!("Hello, {}!", name);
    }
}

fn main() {
    greeter::greet("Rustacean");
}
