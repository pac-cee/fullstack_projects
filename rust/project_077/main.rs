use reqwest::multipart;
use reqwest::Client;
use std::fs;

#[tokio::main]
async fn main() -> Result<(), Box<dyn std::error::Error>> {
    let file_bytes = fs::read("file.txt")?;
    let part = multipart::Part::bytes(file_bytes).file_name("file.txt");
    let form = multipart::Form::new().part("file", part);
    let client = Client::new();
    let resp = client.post("http://localhost:8000/upload")
        .multipart(form)
        .send().await?;
    println!("Server response: {}", resp.text().await?);
    Ok(())
}
