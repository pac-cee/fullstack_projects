use reqwest;
use std::fs::File;
use std::io::copy;
use std::env;

#[tokio::main]
async fn main() -> Result<(), Box<dyn std::error::Error>> {
    let url = "https://www.rust-lang.org/logos/rust-logo-512x512.png";
    let mut resp = reqwest::get(url).await?;
    let mut out = File::create("downloaded.png")?;
    copy(&mut resp.bytes().await?.as_ref(), &mut out)?;
    println!("Downloaded image to downloaded.png");
    Ok(())
}
