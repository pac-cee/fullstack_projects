use reqwest;
use scraper::{Html, Selector};

#[tokio::main]
async fn main() -> Result<(), Box<dyn std::error::Error>> {
    let url = "https://www.rust-lang.org/";
    let body = reqwest::get(url).await?.text().await?;
    let document = Html::parse_document(&body);
    let selector = Selector::parse("a").unwrap();
    println!("Links on {}:", url);
    for element in document.select(&selector) {
        if let Some(link) = element.value().attr("href") {
            println!("{}", link);
        }
    }
    Ok(())
}
