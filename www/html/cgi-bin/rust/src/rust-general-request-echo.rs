use std::io::{self, BufRead};

fn main() {
    let mut str_buf = String::new();

    // Print HTML header
    println!("Cache-Control: no-cache");
    println!("Content-type: text/html\n");
    println!(
        "<html><head><title>General Request Echo</title></head> \
        <body><h1 align=center>General Request Echo</h1> \
        <hr/>"
    );

    // Get environment vars
    println!("<table>");
    println!(
        "<tr><td>Protocol:</td><td>{}</td></tr>",
        std::env::var("SERVER_PROTOCOL").unwrap()
    );
    println!(
        "<tr><td>Method:</td><td>{}</td></tr>",
        std::env::var("REQUEST_METHOD").unwrap()
    );

    let stdin = io::stdin();
    let mut handle = stdin.lock();
    handle.read_line(&mut str_buf).unwrap();
    println!("<tr><td>Message Body:</td><td> {}</td></tr>", str_buf.trim());

    // Print HTML footer
    println!("</body>");
    println!("</html>");
}
