<?php
    /* Open connection to "userdata" MySQL database. */
    $mysqli = new mysqli("localhost", "root", "123", "userdata");

    /* Check the connection. */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT DATE_FORMAT(p.pageLoadEndTime, '%Y-%m-%d %H:00:00') AS hour, AVG(p.pageLoadTime) AS avgLoadTime, s.userAgent
        FROM performance p
        INNER JOIN static s ON s.id = p.id
        WHERE s.userAgent LIKE '%android%' 
        GROUP BY hour, s.userAgent
        ORDER BY hour";

    // OR s.userAgent LIKE '%mac%' OR s.userAgent LIKE '%windows%'
    // INNER JOIN static s ON p.userSessionID = s.userSessionID
    // 
    $result = $mysqli->query($query);
    $data = array();
    $hourArray = [];
    $loadTimeArray = [];
    $deviceArray = [];
    if ($result) {
        // Fetch rows from the result set
        while ($row = $result->fetch_assoc()) {
            // Store each row in the $data array
            $data[] = $row;
        }

        // Free the result set
        $result->free();
    }

    // Use the collected data
    // You can loop over $data array to access each row
    foreach ($data as $row) {
        $hour = $row['hour'];
        $avgLoadTime = $row['avgLoadTime'];
        $userAgent = $row['userAgent'];
        if ((strpos($userAgent, "Android") !== false) || (strpos($userAgent, "Linux") !== false)) {
            $userAgent = "Android";
        } elseif (strpos($userAgent, 'Windows') !== false) {
            $userAgent = "Windows";
        } elseif (strpos($userAgent, 'Macintosh') !== false) {
            $userAgent = "Macintosh";
        }
        array_push($hourArray, $hour);
        array_push($loadTimeArray, $avgLoadTime);
        array_push($deviceArray, $userAgent);
    }

    $loadtimeAndroid = array(
        "Hour" => $hourArray,
        "AvgLoadTime" => $loadTimeArray,
        "UserAgent" => $deviceArray
    );
    $loadtimeAndroidJSON = json_encode($loadtimeAndroid);

    // Close the database connection
    $mysqli->close();
?>

<?php
    /* Open connection to "userdata" MySQL database. */
    $mysqli = new mysqli("localhost", "root", "123", "userdata");

    /* Check the connection. */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT DATE_FORMAT(p.pageLoadEndTime, '%Y-%m-%d %H:00:00') AS hour, AVG(p.pageLoadTime) AS avgLoadTime, s.userAgent
        FROM performance p
        INNER JOIN static s ON s.id = p.id
        WHERE s.userAgent LIKE '%windows%' 
        GROUP BY hour, s.userAgent
        ORDER BY hour";

    // OR s.userAgent LIKE '%mac%' OR s.userAgent LIKE '%windows%'
    // INNER JOIN static s ON p.userSessionID = s.userSessionID
    $result = $mysqli->query($query);
    $data = array();
    $hourArray = [];
    $loadTimeArray = [];
    $deviceArray = [];
    if ($result) {
        // Fetch rows from the result set
        while ($row = $result->fetch_assoc()) {
            // Store each row in the $data array
            $data[] = $row;
        }

        // Free the result set
        $result->free();
    }

    // Use the collected data
    // You can loop over $data array to access each row
    foreach ($data as $row) {
        $hour = $row['hour'];
        $avgLoadTime = $row['avgLoadTime'];
        $userAgent = $row['userAgent'];
        if ((strpos($userAgent, "Android") !== false) || (strpos($userAgent, "Linux") !== false)) {
            $userAgent = "Android";
        } elseif (strpos($userAgent, 'Windows') !== false) {
            $userAgent = "Windows";
        } elseif (strpos($userAgent, 'Macintosh') !== false) {
            $userAgent = "Macintosh";
        }
        array_push($hourArray, $hour);
        array_push($loadTimeArray, $avgLoadTime);
        array_push($deviceArray, $userAgent);
    }

    $loadtimeWindows = array(
        "Hour" => $hourArray,
        "AvgLoadTime" => $loadTimeArray,
        "UserAgent" => $deviceArray
    );
    $loadtimeWindowsJSON = json_encode($loadtimeWindows);

    // Close the database connection
    $mysqli->close();
?>

<?php
    /* Open connection to "userdata" MySQL database. */
    $mysqli = new mysqli("localhost", "root", "123", "userdata");

    /* Check the connection. */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT DATE_FORMAT(p.pageLoadEndTime, '%Y-%m-%d %H:00:00') AS hour, AVG(p.pageLoadTime) AS avgLoadTime, s.userAgent
        FROM performance p
        INNER JOIN static s ON s.id = p.id
        WHERE s.userAgent LIKE '%mac%'
        GROUP BY hour, s.userAgent
        ORDER BY hour";

    // OR  OR s.userAgent LIKE '%windows%'
    // INNER JOIN static s ON p.userSessionID = s.userSessionID
    $result = $mysqli->query($query);
    $data = array();
    $hourArray = [];
    $loadTimeArray = [];
    $deviceArray = [];
    if ($result) {
        // Fetch rows from the result set
        while ($row = $result->fetch_assoc()) {
            // Store each row in the $data array
            $data[] = $row;
        }

        // Free the result set
        $result->free();
    }

    // Use the collected data
    // You can loop over $data array to access each row
    foreach ($data as $row) {
        $hour = $row['hour'];
        $avgLoadTime = $row['avgLoadTime'];
        $userAgent = $row['userAgent'];
        if ((strpos($userAgent, "Android") !== false) || (strpos($userAgent, "Linux") !== false)) {
            $userAgent = "Android";
        } elseif (strpos($userAgent, 'Windows') !== false) {
            $userAgent = "Windows";
        } elseif (strpos($userAgent, 'Macintosh') !== false) {
            $userAgent = "Macintosh";
        }
        array_push($hourArray, $hour);
        array_push($loadTimeArray, $avgLoadTime);
        array_push($deviceArray, $userAgent);
    }

    $loadtimeMac = array(
        "Hour" => $hourArray,
        "AvgLoadTime" => $loadTimeArray,
        "UserAgent" => $deviceArray
    );
    $loadtimeMacJSON = json_encode($loadtimeMac);

    // Close the database connection
    $mysqli->close();
?>



<!DOCTYPE html>
<html>
<head>
  <!-- Include ZingGrid and ZingChart library -->
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
  <style>
    html,
    body,
    #chart-container {
      height: 100%;
      width: 100%;
    }
  </style>
</head>
<body>
  <!-- Define the ZingGrid element -->
    <div id='chart-container'></div>
    <script>
    // Assuming you have the JSON data in the variable $loadtimebydeviceJSON

    // Parse the JSON data
    var androidData = JSON.parse('<?php echo $loadtimeAndroidJSON; ?>');
    var macData = JSON.parse('<?php echo $loadtimeMacJSON; ?>');
    var windowsData = JSON.parse('<?php echo $loadtimeWindowsJSON; ?>');
    // Print the first element
    console.log(androidData);
    console.log(macData);
    console.log(windowsData);

    var chartData = {
    Hour: windowsData.Hour.concat(androidData.Hour, macData.Hour),
    AvgLoadTime: windowsData.AvgLoadTime.concat(androidData.AvgLoadTime, macData.AvgLoadTime),
    UserAgent: windowsData.UserAgent.concat(androidData.UserAgent, macData.UserAgent)
    };
    console.log(chartData);
    console.log(windowsData.AvgLoadTime);

    var chartConfig = {
    type: 'line',
    series: [
        {
        values: windowsData.AvgLoadTime,
        text: 'Windows'
        },
        {
        values: androidData.AvgLoadTime,
        text: 'Android'
        },
        {
        values: macData.AvgLoadTime,
        text: 'Mac'
        }
    ],
    scaleX: {
        labels: chartData.Hour
        },
    scaleY: {
                minValue: 0            
            }
    };

    // Render the chart
    zingchart.render({
    id: 'chart-container',
    data: chartConfig,
    height: '100%',
    width: '100%'
    });
    </script>

</body>
</html>

