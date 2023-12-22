use std::env;

fn main() {
    // Print HTML header
    println!("Cache-Control: no-cache");
    println!("Content-type: text/html\n");

    println!("<html><head><title>GET query string</title></head>\
	<body><h1 align=center>GET query string</h1>\
  	<hr/>");

    // Get and format query string
    let query_string = env::var("QUERY_STRING").unwrap_or_else(|_| "".to_string());
    println!("Raw query string: {}<br/><br/>", query_string);

    let query_pairs: Vec<_> = query_string.split('&').map(|pair| {
        let mut parts = pair.split('=');
        let var = parts.next().unwrap_or("");
        let val = parts.next().unwrap_or("");
        (var, val)
    }).collect();

    println!("<table> Formatted Query String:");
    for (var, val) in query_pairs {
        println!("<tr><td>{:?}:</td><td>{:?}</td></tr>", var, val);
    }
    println!("</table>");

    // Print HTML footer
    println!("</body>");
    println!("</html>");
}
