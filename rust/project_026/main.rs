use rand::Rng;

fn main() {
    let num = rand::thread_rng().gen_range(1..=100);
    println!("Random number: {}", num);
}
