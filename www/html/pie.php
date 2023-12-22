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

    $deviceCountsJSON = json_encode($deviceCounts);
    /* Close the connection */
    echo ".";
    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart</title>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";</script>
    <style>
        body {
            background-color: black;
        }
        #pieChart {
            background-color: lightgray; /* Set the background color of the chart container */
            padding: 20px; /* Add padding to the container if desired */
            padding-bottom: -20px;
        }
    </style>
</head>
<body>
    <div id="pieChart"></div>
    <script>
        let deviceCounts = <?php echo $deviceCountsJSON ?>;
        let devices = Object.keys(deviceCounts);
        let counts = Object.values(deviceCounts);
        let pieChart = {
            type: "pie",
            series: [
                {
                    values: [counts[0]],
                    text: devices[0]                
                },
                {
                    values: [counts[1]],
                    text: devices[1]
                },
                {
                    values: [counts[2]],
                    text: devices[2]
                },
                {
                    values: [counts[3]],
                    text: devices[3]
                }
            ],
            legend: {
                align: "right",
                backgroundColor: "lightgray",
                borderWidth: 0,
                item: {
                    cursor: "pointer"
                },
                marker: {
                    type: "circle",
                    cursor: "pointer",
                    size: 10
                },
                toggleAction: "remove",
                margin: "225px"
            },
            title: {
                text: "What operating system do users access our site with?",
                fontSize: 18,
                fontColor: "#333",
                bold: true
            },
            subtitle: {
                text: "Click on multiple pies."
            },
            plot: {
                valueBox: {
                    fontColor: "#000000"
                }
            }
        };
        zingchart.loadModules("selection-tool", function() {
            zingchart.render({
                id: "pieChart",
                data: pieChart,
                height: "100%",
                width: "100%",
                modules: "selection-tool"
            });
        });
    </script>
</body>
</html>