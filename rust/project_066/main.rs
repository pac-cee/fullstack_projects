use chrono::Local;

fn main() {
    let now = Local::now();
    println!("Current date and time: {}", now.format("%Y-%m-%d %H:%M:%S"));
}
