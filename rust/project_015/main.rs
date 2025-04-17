struct Person {
    name: String,
    age: u8,
}

fn main() {
    let person = Person { name: String::from("Alice"), age: 30 };
    println!("Name: {}, Age: {}", person.name, person.age);
}
