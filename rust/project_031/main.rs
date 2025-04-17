fn main() {
    let numbers = vec![1, 2, 3, 4, 5, 6];
    let sum: i32 = numbers.iter().filter(|&&x| x % 2 == 0).sum();
    println!("Sum of even numbers: {}", sum);
}
