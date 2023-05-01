package main

import (
	"fmt"
	"os"
	"strings"
)

func main() {
	// Headers
	fmt.Println("Cache-Control: no-cache")

	// Get Name from Environment
	var username string
	fmt.Scan(&username)

	// Check to see if a proper name was sent
	var name string
	if strings.HasPrefix(username, "username=") {
		name = username[9:]
	}

	// Set the cookie using a header, add extra \n to end headers
	if len(name) > 0 {
		fmt.Println("Content-type: text/html")
		fmt.Printf("Set-Cookie: %s\n\n", name)
	} else {
		fmt.Println("Content-type: text/html\n")
	}

	// Body - HTML
	fmt.Println("<html>")
	fmt.Println("<head><title>Go Sessions</title></head>")
	fmt.Println("<body>")
	fmt.Println("<h1>Go Sessions Page 1</h1>")
	fmt.Println("<table>")

	// First check for new Cookie, then Check for old Cookie
	cookie := os.Getenv("HTTP_COOKIE")
	if len(name) > 0 {
		fmt.Printf("<tr><td>Cookie:</td><td>%s</td></tr>\n", name)
	} else if cookie != "" && !strings.Contains(cookie, "destroyed") {
		fmt.Printf("<tr><td>Cookie:</td><td>%s</td></tr>\n", cookie)
	} else {
		fmt.Println("<tr><td>Cookie:</td><td>None</td></tr>")
	}

	fmt.Println("</table>")

	// Links for other pages
	fmt.Println("<br />")
	fmt.Println("<a href=\"/cgi-bin/go/go-session-2\">Session Page 2</a>")
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
