use std::{thread, time};

fn main() {
    for i in 1..=10 {
        print!("\r[{}>{}] {}%", "=".repeat(i), " ".repeat(10-i), i*10);
        std::io::Write::flush(&mut std::io::stdout()).unwrap();
        thread::sleep(time::Duration::from_millis(200));
    }
    println!("\nDone!");
}
