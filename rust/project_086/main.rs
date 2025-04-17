use notify::{Watcher, RecursiveMode, watcher};
use std::sync::mpsc::channel;
use std::time::Duration;

fn main() {
    let (tx, rx) = channel();
    let mut watcher = watcher(tx, Duration::from_secs(2)).unwrap();
    watcher.watch(".", RecursiveMode::Recursive).unwrap();
    println!("Watching current directory for changes...");
    loop {
        match rx.recv() {
            Ok(event) => println!("Event: {:?}", event),
            Err(e) => println!("Watch error: {:?}", e),
        }
    }
}
