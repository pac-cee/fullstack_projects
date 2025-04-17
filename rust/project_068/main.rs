use tiny_http::{Server, Response};

fn main() {
    let server = Server::http("0.0.0.0:8000").unwrap();
    println!("Server running on http://localhost:8000");
    for request in server.incoming_requests() {
        let response = Response::from_string("Hello, Rust HTTP!");
        request.respond(response).unwrap();
    }
}
