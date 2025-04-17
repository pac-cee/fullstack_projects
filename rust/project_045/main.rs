trait Describe {
    fn describe(&self) -> String;
}

struct Book {
    title: String,
}

impl Describe for Book {
    fn describe(&self) -> String {
        format!("Book: {}", self.title)
    }
}

fn main() {
    let b = Book { title: String::from("Rust Programming") };
    println!("{}", b.describe());
}
