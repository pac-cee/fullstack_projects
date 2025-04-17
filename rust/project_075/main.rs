use pulldown_cmark::{Parser, html};
use std::fs;

fn main() {
    let md = fs::read_to_string("README.md").unwrap();
    let parser = Parser::new(&md);
    let mut html_output = String::new();
    html::push_html(&mut html_output, parser);
    fs::write("output.html", html_output).unwrap();
    println!("Converted README.md to output.html");
}
