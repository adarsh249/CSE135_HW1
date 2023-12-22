package main

import "fmt"

func main() {

	// Header
	fmt.Println("Cache-Control: no-cache")
	fmt.Println("Content-type: text/html\n")

	// Body
	fmt.Println("<html>")
	fmt.Println("<head><title>State Demo</title></head>")
	fmt.Println("<body>")
	fmt.Println("<h1 align=\"center\">Session Test</h1>")
	fmt.Println("<hr>")
	fmt.Println("<label for=\"cgi-lang\">CGI using Go</label>")
	fmt.Println("<form action=\"/cgi-bin/go/go-session-1\" method=\"Post\" id=\"form\">")
	fmt.Println("<label>What is your name? <input type=\"text\" name=\"username\" autocomplete=\"off\"></label>")
	fmt.Println("<br>")
	fmt.Println("<input type=\"submit\" value=\"Test Sessioning\">")
	fmt.Println("</form>")
	fmt.Println("<a href=\"/\" style=\"display:inline-block;margin-top:20px;\">Home</a>")
	fmt.Println("</body>")
	fmt.Println("</html>")
}