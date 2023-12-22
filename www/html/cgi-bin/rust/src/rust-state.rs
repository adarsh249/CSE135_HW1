fn main() {
    // Headers
    println!("Cache-Control: no-cache");
    println!("Content-type: text/html\n");

    println!("<html>");
    println!("<head><title>State Demo</title></head>");
    println!("<body>");
    println!("<h1 align=\"center\">Rust Session Test</h1>");
    println!("<hr>");
    println!("<label for=\"cgi-lang\">CGI using Rust</label>");
    println!("<form action=\"/cgi-bin/rust/target/debug/rust-sessions-1\" method=\"Post\" id=\"form\">");
    println!("<label>What is your name? <input type=\"text\" name=\"username\" autocomplete=\"off\"></label>");
    println!("<br>");
    println!("<input type=\"submit\" value=\"Test Sessioning\">");
    println!("</form>");
    println!("<a href=\"/\" style=\"display:inline-block;margin-top:20px;\">Home</a>");
    println!("</body>");
    println!("</html>");
}
