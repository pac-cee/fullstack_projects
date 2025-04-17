use warp::Filter;
use serde::{Serialize, Deserialize};

#[derive(Serialize, Deserialize)]
struct Message {
    text: String,
}

#[tokio::main]
async fn main() {
    let hello = warp::path("hello")
        .map(|| warp::reply::json(&Message { text: "Hello, world!".to_string() }));
    println!("Serving JSON API on http://localhost:3030/hello");
    warp::serve(hello).run(([127, 0, 0, 1], 3030)).await;
}
