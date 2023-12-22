package main

import "fmt"

func main() {
    // Headers
    fmt.Println("Cache-Control: no-cache")
    fmt.Println("Set-Cookie: destroyed")
    fmt.Println("Content-type: text/html\n")

    // Body - HTML
    fmt.Println("<html>")
    fmt.Println("<head><title>Go Session Destroyed</title></head>")
    fmt.Println("<body>")
    fmt.Println("<h1>Go Session Destroyed</h1>")

    // Links
    fmt.Println("<a href=\"/cgi-bin/go/go-session-1\">Back to Page 1</a>")
    fmt.Println("<br />")
    fmt.Println("<a href=\"/cgi-bin/go/go-session-2\">Back to Page 2</a>")
    fmt.Println("<br />")
    fmt.Println("<a href=\"/cgi-bin/go/go-state-demo\">Go CGI Form</a>")

    fmt.Println("</body>")
    fmt.Println("</html>")
}
