use std::env;
use chrono::Local;

fn main() {
    let now = Local::now();
    let current_time = now.format("%a %b %d %H:%M:%S %Y");
    println!("Cache-Control: no-cache");
    println!("Content-type: application/json\n");
    println!("{{\n\t\"message\": \"This page was generated with the Rust programming language\",\n\t\"date\": \"{}\",\n\t\"currentIP\": \"{}\"\n}}", current_time, env::var("REMOTE_ADDR").unwrap_or_default());
}
