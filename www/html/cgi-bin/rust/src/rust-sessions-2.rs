use std::env;
use std::io::{self, BufRead};


fn main() {
    // Headers
    println!("Cache-Control: no-cache");
    println!("Content-type: text/html\n");
    // Body - HTML
    println!("<html>");
    println!("<head><title>Rust Sessions</title></head>");
    println!("<body>");
    println!("<h1>Rust Sessions Page 2</h1>");
    println!("<table>");

    // First check for new Cookie, then Check for old Cookie
    if let Some(cookie) = std::env::var("HTTP_COOKIE").ok() {
        if cookie.contains("destroyed")  {
            println!("<tr><td>Cookie:</td><td>None</td></tr>");
        }
        else {
            println!("<tr><td>Cookie:</td><td>{}</td></tr>", cookie);
        }
    }
    
    println!("</table>");

    // Links for other pages
    println!("<br />");
    println!("<a href=\"/cgi-bin/rust/target/debug/rust-sessions-1\">Session Page 1</a>");
    println!("<br />");
    println!("<a href=\"/cgi-bin/rust/target/debug/rust-state\">Rust CGI Form</a>");
    println!("<br /><br />");

    // Destroy Cookie button
    println!("<form action=\"/cgi-bin/rust/target/debug/rust-destroy-session\" method=\"get\">");
    println!("<button type=\"submit\">Destroy Session</button>");
    println!("</form>");

    println!("</body>");
    println!("</html>");
}