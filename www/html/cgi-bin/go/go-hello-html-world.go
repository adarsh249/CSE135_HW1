package main

import (
	"fmt"
	"os"
	"time"
)

func main(){
	t := time.Now()

	fmt.Printf("Cache-Control: no-cache\n")
    fmt.Printf("Content-type: text/html\n\n")

	fmt.Printf("<html><head><title>Hello CGI World</title></head><body><h1 align=center>Hello HTML World</h1><hr/>\n")

	fmt.Printf("Hello World<br/>\n")
	fmt.Printf("This page was generated with the Go programming language<br/>\n")
	fmt.Printf("This program was generated at: %s\n<br/>", t.Format(time.RFC1123))
	fmt.Printf("Your current IP address is: %s<br/>", os.Getenv("REMOTE_ADDR"))

	fmt.Printf("</body></html>")
}