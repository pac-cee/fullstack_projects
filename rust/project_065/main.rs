use regex::Regex;

fn main() {
    let text = "The quick brown fox jumps over the lazy dog.";
    let re = Regex::new(r"\b\w{4}\b").unwrap();
    for mat in re.find_iter(text) {
        println!("Found 4-letter word: {}", mat.as_str());
    }
}
