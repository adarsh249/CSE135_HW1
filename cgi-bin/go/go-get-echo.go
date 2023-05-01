package main

import (
    "fmt"
    "os"
    "strings"
)

func main() {
    // Print HTML header
    fmt.Println("Cache-Control: no-cache")
    fmt.Println("Content-type: text/html\n")
    fmt.Println("<html><head><title>GET query string</title></head><body><h1 align=center>GET query string</h1><hr/>")

    // Get and format query string
    rawQuery := os.Getenv("QUERY_STRING")
    fmt.Printf("Raw query string: %s\n<br/><br/>", rawQuery)
    fmt.Println("<table> Formatted Query String:")
    query := strings.Split(rawQuery, "&")
    for _, pair := range query {
        splitPair := strings.Split(pair, "=")
        if len(splitPair) != 2 {
            fmt.Fprintln(os.Stderr, "<empty field>")
            continue
        }
        fmt.Printf("<tr><td>%-8s:</td><td>%s</td></tr>\n", splitPair[0], splitPair[1])
    }
    fmt.Println("</table>")

    // Print HTML footer
    fmt.Println("</body></html>")
}
