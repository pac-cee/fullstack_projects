use std::{env, thread, time};

fn main() {
    let args: Vec<String> = env::args().collect();
    if args.len() != 2 {
        println!("Usage: <minutes>");
        return;
    }
    let mins: u64 = args[1].parse().unwrap();
    let total_secs = mins * 60;
    for sec in (1..=total_secs).rev() {
        print!("\rTime left: {:02}:{:02}", sec / 60, sec % 60);
        std::io::Write::flush(&mut std::io::stdout()).unwrap();
        thread::sleep(time::Duration::from_secs(1));
    }
    println!("\nPomodoro session complete!");
}
