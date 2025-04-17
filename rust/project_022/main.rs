fn swap(a: i32, b: i32) -> (i32, i32) {
    (b, a)
}

fn main() {
    let (x, y) = (5, 10);
    let (y, x) = swap(x, y);
    println!("x = {}, y = {}", x, y);
}
