fn get_first(vec: &Vec<i32>) -> Option<&i32> {
    vec.get(0)
}

fn main() {
    let v = vec![10, 20, 30];
    match get_first(&v) {
        Some(x) => println!("First element: {}", x),
        None => println!("Vector is empty"),
    }
}
