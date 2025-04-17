use tiny_http::{Server, Response, Request};
use std::fs;

fn main() {
    let server = Server::http("0.0.0.0:8080").unwrap();
    println!("Serving files on http://localhost:8080");
    for request in server.incoming_requests() {
        let path = &request.url()[1..]; // Remove leading '/'
        let file_path = if path.is_empty() { "index.html" } else { path };
        match fs::read(file_path) {
            Ok(data) => {
                let response = Response::from_data(data);
                request.respond(response).unwrap();
            },
            Err(_) => {
                let response = Response::from_string("404 Not Found").with_status_code(404);
                request.respond(response).unwrap();
            }
        }
    }
}
