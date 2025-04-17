use std::env;

fn check_strength(pwd: &str) -> &'static str {
    let len = pwd.len();
    let has_upper = pwd.chars().any(|c| c.is_uppercase());
    let has_lower = pwd.chars().any(|c| c.is_lowercase());
    let has_digit = pwd.chars().any(|c| c.is_digit(10));
    let has_special = pwd.chars().any(|c| !c.is_alphanumeric());
    match (len, has_upper, has_lower, has_digit, has_special) {
        (l, true, true, true, true) if l >= 12 => "Very strong",
        (l, true, true, true, _) if l >= 8 => "Strong",
        (l, _, _, _, _) if l < 8 => "Weak",
        _ => "Moderate",
    }
}

fn main() {
    let args: Vec<String> = env::args().collect();
    if args.len() != 2 {
        println!("Usage: <password>");
        return;
    }
    let pwd = &args[1];
    let strength = check_strength(pwd);
    println!("Password strength: {}", strength);
}
