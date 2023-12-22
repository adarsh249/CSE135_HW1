package main

import (
    "fmt"
    "os"
	"bufio"
)

func main() {
    // Print HTML header
    fmt.Println("Cache-Control: no-cache")
    fmt.Println("Content-type: text/html\n")
    fmt.Println("<html><head><title>General Request Echo</title></head>" +
        "<body><h1 align=center>General Request Echo</h1>" +
        "<hr/>")

    // Get environment vars
    fmt.Println("<table>")
    fmt.Printf("<tr><td>Protocol:</td><td>%s</td></tr>\n", os.Getenv("SERVER_PROTOCOL"))
    fmt.Printf("<tr><td>Method:</td><td>%s</td></tr>\n", os.Getenv("REQUEST_METHOD"))
    fmt.Printf("<tr><td>Query String:</td><td>%s</td></tr>\n", os.Getenv("QUERY_STRING"))
    
	reader := bufio.NewReader(os.Stdin)
    str, _ := reader.ReadString('\n')
	fmt.Printf("<tr><td>Message Body:</td><td> %s</td></tr>\n", str)

    // Print HTML footer
    fmt.Println("</body>")
    fmt.Println("</html>")
}


