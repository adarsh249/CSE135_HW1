#!/usr/bin/expect -f

set password "123"
set timeout -1

while {1} {
    # Attempt to run the command without a password
    spawn sudo -n pm2 restart 1
    expect {
        eof {
            # No password prompt, command executed successfully
            break
        }
        timeout {
            # Password prompt not received within the timeout, assume no password is required
            spawn sudo pm2 restart 1
            expect eof
            break
        }
        "*password for*" {
            # Password prompt received, enter the password
            send "$password\r"
            expect eof
            break
        }
    }

    # Wait for an hour (3600 seconds)
    sleep 3600
}
