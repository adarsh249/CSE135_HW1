package main

import (
	"fmt"
	"os"
	"strings"
)

func main() {
	// Headers
	fmt.Printf("Cache-Control: no-cache\n");
	fmt.Printf("Content-type: text/html\n\n");

	// Body - HTML
	fmt.Println("<html>")
	fmt.Println("<head><title>Go Sessions</title></head>")
	fmt.Println("<body>")
	fmt.Println("<h1>Go Sessions Page 2</h1>")
	fmt.Println("<table>")

	// First check for new Cookie, then Check for old Cookie
	cookie := os.Getenv("HTTP_COOKIE")
	if cookie != "" && !strings.Contains(cookie, "destroyed") {
		fmt.Printf("<tr><td>Cookie:</td><td>%s</td></tr>\n", cookie)
	} else {
		fmt.Println("<tr><td>Cookie:</td><td>None</td></tr>")
	}

	fmt.Println("</table>")

	// Links for other pages
	fmt.Println("<br />")
	fmt.Println("<a href=\"/cgi-bin/go/go-session-1\">Session Page 1</a>")
	fmt.Println("<br />")
	fmt.Println("<a href=\"/cgi-bin/go/go-state-demo\">Go CGI Form</a>")
	fmt.Println("<br /><br />")

	// Destroy Cookie button
	fmt.Println("<form action=\"/cgi-bin/go/go-destroy-session\" method=\"get\">")
	fmt.Println("<button type=\"submit\">Destroy Session</button>")
	fmt.Println("</form>")

	fmt.Println("</body>")
	fmt.Println("</html>")
}