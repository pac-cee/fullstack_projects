use csv::Writer;
use serde::Serialize;

#[derive(Serialize)]
struct Record {
    name: String,
    age: u8,
}

fn main() {
    let mut wtr = Writer::from_path("output.csv").unwrap();
    let records = vec![
        Record { name: "Alice".to_string(), age: 30 },
        Record { name: "Bob".to_string(), age: 25 },
    ];
    for rec in records {
        wtr.serialize(rec).unwrap();
    }
    wtr.flush().unwrap();
    println!("Wrote output.csv");
}
