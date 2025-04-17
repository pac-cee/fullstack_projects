use tera::{Tera, Context};

fn main() {
    let tera = match Tera::new("templates/*.html") {
        Ok(t) => t,
        Err(e) => { println!("Parsing error(s): {}", e); return; }
    };
    let mut context = Context::new();
    context.insert("name", "Rustacean");
    let rendered = tera.render("hello.html", &context).unwrap();
    println!("{}", rendered);
}
