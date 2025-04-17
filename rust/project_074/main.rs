use reqwest;
use serde_json::Value;

#[tokio::main]
async fn main() -> Result<(), Box<dyn std::error::Error>> {
    let url = "https://api.github.com/repos/rust-lang/rust";
    let client = reqwest::Client::new();
    let resp = client.get(url)
        .header("User-Agent", "Rust Example")
        .send().await?;
    let json: Value = resp.json().await?;
    println!("Repo: {}\nStars: {}", json["full_name"], json["stargazers_count"]);
    Ok(())
}
