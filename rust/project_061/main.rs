use serde::{Serialize, Deserialize};

#[derive(Serialize, Deserialize, Debug)]
struct Person {
    name: String,
    age: u8,
}

fn main() {
    let person = Person { name: "Alice".to_string(), age: 30 };
    let json = serde_json::to_string(&person).unwrap();
    println!("Serialized to JSON: {}", json);
    let deserialized: Person = serde_json::from_str(&json).unwrap();
    println!("Deserialized: {:?}", deserialized);
}
