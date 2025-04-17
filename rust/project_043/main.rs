struct Counter {
    value: i32,
}

impl Counter {
    fn new() -> Self { Counter { value: 0 } }
    fn increment(&mut self) { self.value += 1; }
    fn reset(&mut self) { self.value = 0; }
}

fn main() {
    let mut counter = Counter::new();
    counter.increment();
    counter.increment();
    println!("Counter: {}", counter.value);
    counter.reset();
    println!("Counter after reset: {}", counter.value);
}
