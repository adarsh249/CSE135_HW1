<?php
    //Open connection to "zing_db" MySQL database.
    $mysqli = new mysqli("localhost", "root", "123", "userdata");

   // Check the connection. 
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $loadTimeData = mysqli_query($mysqli, "SELECT pageLoadTime, pageLoadEndTime, id FROM userdata.performance");
    $android = [];
    $windows = [];
    $macintosh = [];
    if($loadTimeData){
        while($loadTimeRow = $loadTimeData->fetch_assoc()) {
            $pageLoadTime = $loadTimeRow["pageLoadTime"];
            $datetime = $loadTimeRow["pageLoadEndTime"];
            $datetimeToParse = new DateTime($datetime);
            $timeEntered = $datetimeToParse->format("H:i:s");
            $staticID = $loadTimeRow["id"];
            $deviceData = mysqli_query($mysqli, "SELECT userAgent FROM userdata.static WHERE id = $staticID");
            if($deviceData && $deviceData->num_rows > 0){
                $deviceRow = $deviceData->fetch_assoc();
                $userAgent = $deviceRow["userAgent"];
                if (strpos($userAgent, "Android") !== false) {
                    array_push($android, [$timeEntered, $pageLoadTime]); 
                } elseif (strpos($userAgent, 'Windows') !== false) {
                    array_push($windows, [$timeEntered, $pageLoadTime]);
                } elseif (strpos($userAgent, 'Macintosh') !== false) {
                    array_push($macintosh, [$timeEntered, $pageLoadTime]);
                } 
            }
        }
    }
    echo ".";
    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3 Series Line Chart</title>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <style>
        body {
          background-color: black;
        }
        #barChart {
          background-color: lightgray; /* Set the background color of the chart container */
          padding: 20px; /* Add padding to the container if desired */
        }
    </style>
</head>
<body>
    <div id="lineChart"></div>
    <script>
        let android = <?php echo json_encode($android); ?>;
        let windows = <?php echo json_encode($windows); ?>;
        let macintosh = <?php echo json_encode($macintosh); ?>;
        android = android.map(item => [item[0], parseFloat(item[1])]);
        windows = windows.map(item => [item[0], parseFloat(item[1])]);
        macintosh = macintosh.map(item => [item[0], parseFloat(item[1])]);

        let line = {
            type: "line",
            title: {
                text: "Load Times on Different Operating Systems Over Time",
                fontSize: 18,
                fontColor: "#333",
                bold: true
            },
            series: [
                {
                    values: android,
                    text: "Android"
                },
                {
                    values: windows,
                    text: "Windows"
                },
                {
                    values: macintosh,
                    text: "Macintosh"
                }
            ],
            scaleY: {
                label: {
                    text: "Load Time (ms)",
                    fontSize: "14px",
                    fontColor: "#333"
                }          
            },
            scaleX: {
                label: {
                    text: "Time of the Day (H:M:S)",
                    fontSize: "14px",
                    fontColor: "#333"
                }
            },
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
                toggleAction: "remove"
            }
        };
        zingchart.render({
            id: "lineChart",
            data: line,
            height: "100%",
            width: "100%"
        });
    </script>
</body>
</html>