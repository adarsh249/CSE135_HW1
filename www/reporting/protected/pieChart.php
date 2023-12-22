<?php 
    header('Content-type: application/json');
?>
<?php
    /* Open connection to "zing_db" MySQL database. */
    $mysqli = new mysqli("localhost", "root", "123", "userdata");

    /* Check the connection. */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    /* Fetch result set from t_test table */
    $data=mysqli_query($mysqli, "SELECT userAgent FROM userdata.static");
    $androidCount = 0;
    $iphoneCount = 0;
    $windowsCount = 0;
    $macintoshCount = 0;
    if ($data) {
        // Fetch rows from the result set
        while ($row = $data->fetch_assoc()) {
            // Access the userAgent column value
            $userAgent = $row['userAgent'];
            
            // Do something with the value (e.g., display it)
            if (strpos($userAgent, "Android") !== false) {
                $androidCount++;
            } elseif (strpos($userAgent, 'iPhone') !== false) {
                $iphoneCount++;
            } elseif (strpos($userAgent, 'Windows') !== false) {
                $windowsCount++;
            } elseif (strpos($userAgent, 'Macintosh') !== false) {
                $macintoshCount++;
            }
        }
        // Free the result set
        $data->free();
    }
    $deviceCounts = array(
        "Android" => $androidCount,
        "iOS" => $iphoneCount,
        "Windows" => $windowsCount,
        "Macintosh" => $macintoshCount
    );

    $deviceCountsJSON = json_encode($deviceCounts, JSON_PRETTY_PRINT);
    echo $deviceCountsJSON;
    $mysqli->close();
?>
