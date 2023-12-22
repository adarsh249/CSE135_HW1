<?php
    header('Content-Type: application/json');
    $mysqli = new mysqli("localhost", "root", "123", "userauth");
    if($mysqli->connect_error) {
        die('Connect Errorr (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
    }
    $mydata = [];
        if($result = $mysqli->query("SELECT * FROM users")) {
            $mydata = $result->fetch_all(MYSQLI_ASSOC);
            $result->close();
        }
    echo json_encode($mydata);
    $mysqli->close();
?>