struct Rectangle {
    width: u32,
    height: u32,
}

impl Rectangle {
    fn area(&self) -> u32 {
        self.width * self.height
    }
    fn new(w: u32, h: u32) -> Self {
        Rectangle { width: w, height: h }
    }
}

fn main() {
    let rect = Rectangle::new(10, 5);
    println!("Area: {}", rect.area());
}
