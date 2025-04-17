use reqwest;
use rss::Channel;

#[tokio::main]
async fn main() -> Result<(), Box<dyn std::error::Error>> {
    let url = "https://blog.rust-lang.org/feed.xml";
    let content = reqwest::get(url).await?.bytes().await?;
    let channel = Channel::read_from(&content[..])?;
    println!("Latest articles:");
    for item in channel.items().iter().take(5) {
        println!("- {}", item.title().unwrap_or("No title"));
    }
    Ok(())
}
