use std::fs::File;
use zip::write::FileOptions;
use zip::ZipWriter;
use std::io::Write;

fn main() {
    let path = "archive.zip";
    let file = File::create(path).unwrap();
    let mut zip = ZipWriter::new(file);
    let options = FileOptions::default();
    zip.start_file("hello.txt", options).unwrap();
    zip.write_all(b"Hello from Rust!").unwrap();
    zip.finish().unwrap();
    println!("Created archive.zip");
}
