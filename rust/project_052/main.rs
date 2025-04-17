use std::net::{TcpListener, TcpStream};
use std::io::{Read, Write};

fn handle_client(mut stream: TcpStream) {
    let mut buffer = [0; 512];
    let n = stream.read(&mut buffer).unwrap();
    println!("Received: {}", String::from_utf8_lossy(&buffer[..n]));
    stream.write_all(b"Message received\n").unwrap();
}

fn main() {
    let listener = TcpListener::bind("127.0.0.1:7878").unwrap();
    println!("Server listening on port 7878");
    for stream in listener.incoming() {
        handle_client(stream.unwrap());
    }
}
