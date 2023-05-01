#include <stdio.h>
#include <stdlib.h>

int main(int argc, char **argv, char **envp)
{
    // Headers
    printf("Cache-Control: no-cache\n");
    printf("Content-type: text/html\n\n");

    printf("<html>");
    printf("<head><title>State Demo</title></head>");
    printf("<body>");
    printf("<h1 align=\"center\">Session Test</h1>");
    printf("<hr>");
    printf("<label for=\"cgi-lang\">CGI using C</label>");
    printf("<form action=\"/cgi-bin/C/c-sessions-1.cgi\" method=\"Post\" id=\"form\">");
    printf("<label>What is your name? <input type=\"text\" name=\"username\" autocomplete=\"off\"></label>");
    printf("<br>");
    printf("<input type=\"submit\" value=\"Test Sessioning\">");
    printf("</form>");
    printf("<a href=\"/\" style=\"display:inline-block;margin-top:20px;\">Home</a>");
    printf("</body>");
    printf("</html>");

    return 0;
}