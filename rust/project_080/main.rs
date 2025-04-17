use printpdf::*;
use std::fs::File;
use std::io::BufWriter;

fn main() {
    let (doc, page1, layer1) = PdfDocument::new("PDF_Document", Mm(210.0), Mm(297.0), "Layer 1");
    let current_layer = doc.get_page(page1).get_layer(layer1);
    current_layer.use_text("Hello from Rust PDF!", 48.0, Mm(10.0), Mm(200.0), &IndirectFontRef::new(1));
    let mut out = BufWriter::new(File::create("output.pdf").unwrap());
    doc.save(&mut out).unwrap();
    println!("Created output.pdf");
}
