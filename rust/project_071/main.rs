use tokio_tungstenite::connect_async;
use url::Url;
use futures_util::{SinkExt, StreamExt};

#[tokio::main]
async fn main() {
    let url = Url::parse("wss://echo.websocket.org").unwrap();
    let (mut ws_stream, _) = connect_async(url).await.expect("Failed to connect");
    ws_stream.send("Hello WebSocket!".into()).await.unwrap();
    if let Some(msg) = ws_stream.next().await {
        println!("Received: {}", msg.unwrap());
    }
}
