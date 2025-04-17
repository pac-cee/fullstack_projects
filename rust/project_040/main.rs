trait Speak {
    fn speak(&self);
}

struct Dog;
struct Cat;

impl Speak for Dog {
    fn speak(&self) { println!("Woof!"); }
}
impl Speak for Cat {
    fn speak(&self) { println!("Meow!"); }
}

fn main() {
    let dog = Dog;
    let cat = Cat;
    dog.speak();
    cat.speak();
}
