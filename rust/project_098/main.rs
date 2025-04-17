use rand::seq::SliceRandom;

fn main() {
    let quotes = [
        "The best way to get started is to quit talking and begin doing.",
        "Don't let yesterday take up too much of today.",
        "It's not whether you get knocked down, it's whether you get up.",
        "If you are working on something exciting, it will keep you motivated.",
        "Success is not in what you have, but who you are."
    ];
    let mut rng = rand::thread_rng();
    let quote = quotes.choose(&mut rng).unwrap();
    println!("Random quote: {}", quote);
}
