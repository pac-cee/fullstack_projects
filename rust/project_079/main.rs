use qrcode::QrCode;
use image::Luma;

fn main() {
    let data = "https://www.rust-lang.org/";
    let code = QrCode::new(data).unwrap();
    let image = code.render::<Luma<u8>>().build();
    image.save("qrcode.png").unwrap();
    println!("Generated qrcode.png for: {}", data);
}
