use std::fs::OpenOptions;
use std::io::Write;
use chrono::Local;

fn main() {
    let mut file = OpenOptions::new().append(true).create(true).open("app.log").unwrap();
    let now = Local::now();
    let log = format!("{} - Application started\n", now.format("%Y-%m-%d %H:%M:%S"));
    file.write_all(log.as_bytes()).unwrap();
    println!("Logged: {}", log.trim());
}
