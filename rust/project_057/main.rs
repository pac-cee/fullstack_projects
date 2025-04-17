use std::thread;

fn main() {
    let mut handles = vec![];
    for i in 0..5 {
        handles.push(thread::spawn(move || {
            println!("Hello from thread {}!", i);
        }));
    }
    for handle in handles {
        handle.join().unwrap();
    }
}
