use tokio::net::TcpListener;
use tokio_tungstenite::accept_async;
use futures_util::{StreamExt, SinkExt};

#[tokio::main]
async fn main() {
    let listener = TcpListener::bind("127.0.0.1:9001").await.unwrap();
    println!("WebSocket server running on ws://127.0.0.1:9001");
    while let Ok((stream, _)) = listener.accept().await {
        tokio::spawn(async move {
            let mut ws_stream = accept_async(stream).await.unwrap();
            while let Some(msg) = ws_stream.next().await {
                let msg = msg.unwrap();
                ws_stream.send(msg).await.unwrap();
            }
        });
    }
}
