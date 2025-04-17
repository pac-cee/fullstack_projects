use reqwest;

#[tokio::main]
async fn main() -> Result<(), reqwest::Error> {
    let url = "https://www.rust-lang.org";
    let resp = reqwest::get(url).await?.text().await?;
    println!("Fetched content:\n{}", &resp[..100.min(resp.len())]);
    Ok(())
}
