use std::fs;
use toml;
use serde::Deserialize;

#[derive(Deserialize, Debug)]
struct Config {
    username: String,
    debug: bool,
}

fn main() {
    let content = fs::read_to_string("config.toml").unwrap();
    let config: Config = toml::from_str(&content).unwrap();
    println!("Loaded config: {:?}", config);
}
