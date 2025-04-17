use std::net::TcpStream;
use std::io::{self, Write, Read};

fn main() {
    let mut stream = TcpStream::connect("127.0.0.1:7878").unwrap();
    println!("Enter a message to send:");
    let mut msg = String::new();
    io::stdin().read_line(&mut msg).unwrap();
    stream.write_all(msg.as_bytes()).unwrap();
    let mut buffer = [0; 512];
    let n = stream.read(&mut buffer).unwrap();
    println!("Received: {}", String::from_utf8_lossy(&buffer[..n]));
}
