fn main() {
    // print HTML header
    println!("Cache-Control: no-cache");
    println!("Content-type: text/html\n");

    println!("<html><head><title>Environment Variables</title></head> \
        <body><h1 align=center>Environment Variables</h1> \
        <hr/>\n");

    for (key, value) in std::env::vars() {
        println!("{}={}\n<br/>", key, value);
    }

    // print HTML footer
    println!("</body></html>");
}
