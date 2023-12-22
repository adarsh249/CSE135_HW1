<?php
    //Open connection to "zing_db" MySQL database.
    $mysqli = new mysqli("localhost", "root", "123", "userdata");

   // Check the connection. 
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    /* Fetch result set from t_test table */
    
    $loadTimeData = mysqli_query($mysqli, "SELECT pageLoadTime, id FROM userdata.performance");
    $windows3GTime = 0;
    $windows4GTime = 0;
    $macintosh3GTime = 0;
    $macintosh4GTime = 0;
    $windows3GCount = 0;
    $windows4GCount = 0;
    $macintosh3GCount = 0;
    $macintosh4GCount = 0;

    if ($loadTimeData) {
        // Fetch rows from the result set
        while($loadTimeRow = $loadTimeData->fetch_assoc()) {
          $pageLoadTime = $loadTimeRow["pageLoadTime"];
          $staticID = $loadTimeRow["id"];
          $deviceData = mysqli_query($mysqli, "SELECT userAgent, userNetworkConnectionType FROM userdata.static WHERE id = $staticID");
          if($deviceData && $deviceData->num_rows > 0){
              $deviceRow = $deviceData->fetch_assoc();
              $networkConnectionType = $deviceRow["userNetworkConnectionType"];
              $userAgent = $deviceRow["userAgent"];
              if(strpos($userAgent, "Windows") !== false) {
                if($networkConnectionType === "3g"){
                  $windows3GCount++;
                  $windows3GTime += $pageLoadTime;
                }
                else if($networkConnectionType === "4g") {
                  $windows4GCount++;
                  $windows4GTime += $pageLoadTime;
                }
              }
              else if(strpos($userAgent, "Macintosh") !== false) {
                if($networkConnectionType === "3g"){
                  $macintosh3GCount++;
                  $macintosh3GTime += $pageLoadTime;
                }
                else if($networkConnectionType === "4g") {
                  $macintosh4GCount++;
                  $macintosh4GTime += $pageLoadTime;
                }
              }
          }
        }
        $loadTimeData->free();
        $deviceData->free();
    }
    $macintosh3G = 0;
    $macintosh4G = 0;
    $windows3G = 0;
    $windows4G = 0;
    //averages
    if($macintosh3GCount === 0){
      $macintosh3G = $macintosh3GTime;
    }
    else {
      $macintosh3G = $macintosh3GTime / $macintosh3GCount;
    }
    if($macintosh4GCount === 0){
      $macintosh4G = $macintosh4GTime;
    }
    else {
      $macintosh4G = $macintosh4GTime / $macintosh4GCount;
    }
    if($windows3GCount === 0){
      $windows3G = $windows3GTime;
    }
    else {
      $windows3G = $windows3GTime / $windows3GCount;
    }
    if($windows4GCount === 0){
      $windows4G = $windows4GTime;
    }
    else {
      $windows4G = $windows4GTime / $windows4GCount;
    }
    
    $barArray = array(
        "Macintosh3G" => $macintosh3G,
        "Macintosh4G" => $macintosh4G,
        "Windows3G" => $windows3G,
        "Windows4G" => $windows4G
    );

    $barArrayJSON = json_encode($barArray);
    echo ".";
    $mysqli->close(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2 Series Bar Chart</title>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <style>
        body {
          background-color: black;
        }
        #barChart {
          background-color: lightgray; /* Set the background color of the chart container */
          padding: 20px; /* Add padding to the container if desired */
          padding-bottom: -20px;
        }
    </style>
</head>
<body>
<div id='barChart'></div>
<script>
    let macintosh3G = <?php echo $macintosh3G; ?>;
    let macintosh4G = <?php echo $macintosh4G; ?>;
    let windows3G = <?php echo $windows3G; ?>;
    let windows4G = <?php echo $windows4G; ?>;
    let bar = {
      type: "bar",
      title: {
        text: "Average Load Time on Windows and Macintosh on 3G and 4G Networks",
        fontSize: 18,
        fontColor: "#333",
        bold: true
      },
      scaleX: {
        labels: ["4G", "3G"],
        label: {
          text: "Network Connection Type",
          fontSize: "14px",
          fontColor: "#333"
        }
      },
      scaleY: {
        label: {
          text: "Average Load Time (ms)",
          fontSize: "14px",
          fontColor: "#333"
        }
      },
      series: [
        {
          values: [macintosh4G, macintosh3G],
          text: "Macintosh"
        },
        {
          values: [windows4G, windows3G],
          text: "Windows"
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
          toggleAction: "remove"
      }
    };
    zingchart.render({
        id: "barChart",
        data: bar,
        height: "100%",
        width: "80%"
    });
</script>
</html>