use std::io::{self};

fn main() {
    // Print HTML header
    println!("Cache-Control: no-cache");
    println!("Content-type: text/html\n");

    println!("<html><head><title>POST Message Body</title></head>\
        <body><h1 align=center>POST Message Body</h1>\
        <hr/>\n");

    let mut input = String::new();
    io::stdin().read_line(&mut input).unwrap();

    println!("Message Body: {}<br/>", input);

    // Print HTML footer
    println!("</body>");
    println!("</html>");
}
