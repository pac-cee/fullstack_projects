use rand::Rng;
use std::env;

fn main() {
    let args: Vec<String> = env::args().collect();
    if args.len() != 3 {
        println!("Usage: <sides> <rolls>");
        return;
    }
    let sides: u32 = args[1].parse().unwrap();
    let rolls: u32 = args[2].parse().unwrap();
    let mut rng = rand::thread_rng();
    for i in 1..=rolls {
        let roll = rng.gen_range(1..=sides);
        println!("Roll {}: {}", i, roll);
    }
}
