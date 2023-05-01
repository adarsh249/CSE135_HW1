package main

import (
	"fmt"
	"os"
	"time"
)

func main() {
	t := time.Now()
	buffer := t.Format(time.RFC1123)
	fmt.Printf("Cache-Control: no-cache\r\n")
	fmt.Printf("Content-type: application/json\r\n\r\n")
	fmt.Printf("{\n\t\"message\": \"This page was generated with the Go programming language\",\n")
	fmt.Printf("\t\"date\": \"%s\",\n", buffer)
	fmt.Printf("\t\"currentIP\": \"%s\"\n}\n", os.Getenv("REMOTE_ADDR"))
}
