use std::{thread, time};

fn main() {
    let spinner = ["-", "\\", "|", "/"];
    for i in 0..20 {
        print!("\r{} Working...", spinner[i % spinner.len()]);
        std::io::Write::flush(&mut std::io::stdout()).unwrap();
        thread::sleep(time::Duration::from_millis(100));
    }
    println!("\nDone!");
}
