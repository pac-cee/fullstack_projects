use lettre::{Message, SmtpTransport, Transport};
use lettre::transport::smtp::authentication::Credentials;

fn main() {
    let email = Message::builder()
        .from("sender@example.com".parse().unwrap())
        .to("recipient@example.com".parse().unwrap())
        .subject("Hello from Rust!")
        .body("This is a test email sent from Rust.").unwrap();

    let creds = Credentials::new("smtp_username".to_string(), "smtp_password".to_string());
    let mailer = SmtpTransport::relay("smtp.example.com").unwrap().credentials(creds).build();

    match mailer.send(&email) {
        Ok(_) => println!("Email sent successfully!"),
        Err(e) => println!("Could not send email: {e}"),
    }
}
