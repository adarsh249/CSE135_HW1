package main

import (
    "fmt"
    "os"
    "bufio"
)

func main() {
    //str := make([]byte, 1000)
    // Print HTML header
    fmt.Println("Cache-Control: no-cache")
    fmt.Println("Content-type: text/html\n")
    fmt.Println("<html><head><title>POST Message Body</title></head><body><h1 align=center>POST Message Body</h1><hr/>")

    reader := bufio.NewReader(os.Stdin)
    str, _ := reader.ReadString('\n')
	fmt.Printf("Message Body: %s\n<br/>", str)

    // Print HTML footer
    fmt.Println("</body>")
    fmt.Println("</html>")
}
