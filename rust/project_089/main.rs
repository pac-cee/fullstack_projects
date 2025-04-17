use std::collections::HashMap;
use std::sync::{Arc, Mutex};
use tiny_http::{Server, Request, Response, Method};

fn main() {
    let map = Arc::new(Mutex::new(HashMap::new()));
    let server = Server::http("0.0.0.0:8081").unwrap();
    println!("URL shortener running on http://localhost:8081");
    for request in server.incoming_requests() {
        let map = Arc::clone(&map);
        let url = request.url().to_string();
        match (request.method(), url.as_str()) {
            (&Method::Post, "/shorten") => {
                let mut content = String::new();
                request.as_reader().read_to_string(&mut content).unwrap();
                let key = format!("k{}", map.lock().unwrap().len() + 1);
                map.lock().unwrap().insert(key.clone(), content.clone());
                let resp = Response::from_string(format!("Shortened: /{}", key));
                request.respond(resp).unwrap();
            },
            (&Method::Get, path) if path.len() > 1 => {
                let key = &path[1..];
                let map = map.lock().unwrap();
                if let Some(url) = map.get(key) {
                    let resp = Response::from_string(format!("Redirect to: {}", url));
                    request.respond(resp).unwrap();
                } else {
                    request.respond(Response::from_string("Not found").with_status_code(404)).unwrap();
                }
            },
            _ => {
                request.respond(Response::from_string("Try POST /shorten or GET /<key>")).unwrap();
            }
        }
    }
}
