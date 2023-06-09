fn main() {
    // Headers
    println!("Cache-Control: no-cache");
    println!("Set-Cookie: destroyed");
    println!("Content-type: text/html\n");

    // Body - HTML
    println!("<html>");
    println!("<head><title>Rust Session Destroyed</title></head>");
    println!("<body>");
    println!("<h1>Rust Session Destroyed</h1>");

    // Links
    println!("<a href=\"/cgi-bin/rust/target/debug/rust-sessions-1\">Back to Page 1</a>");
    println!("<br />");
    println!("<a href=\"/cgi-bin/rust/target/debug/rust-sessions-2\">Back to Page 2</a>");
    println!("<br />");
    println!("<a href=\"/cgi-bin/rust/target/debug/rust-state\">C CGI Form</a>");

    println!("</body>");
    println!("</html>");
}
