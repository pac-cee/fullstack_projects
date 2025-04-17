fn main() {
    let mut v = Vec::new();
    v.push(1);
    v.push(2);
    println!("Vector: {:?}", v);
    v.pop();
    println!("After pop: {:?}", v);
}
