<?php     
  header('Content-type: application/json');
?>
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
    $windowsTime = 0;
    $macintoshTime = 0;
    $windowsCount = 0;
    $macintoshCount = 0;
    $iOSCount = 0;
    $iOSTime = 0;
    $androidCount = 0;
    $androidTime = 0;

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
                  $windowsCount++;
                  $windowsTime += $pageLoadTime;
              }
              else if(strpos($userAgent, "Macintosh") !== false) {
                  $macintoshCount++;
                  $macintoshTime += $pageLoadTime;
                
              }
              else if(strpos($userAgent, "iPhone") !== false) {
                    $iOSCount++;
                    $iOSTime += $pageLoadTime;
              }
              else if(strpos($userAgent, "Android") !== false){
                    $androidCount++;
                    $androidTime += $pageLoadTime;
                }
            }
        }
        $loadTimeData->free();
        $deviceData->free();
        }
    $macintosh = 0;
    $windows = 0;
    $iOS = 0;
    $android = 0;
    //averages
    if($macintoshCount === 0){
      $macintosh = $macintoshTime;
    }
    else {
      $macintosh = $macintoshTime / $macintoshCount;
    }
    if($windowsCount === 0){
      $windows = $windowsTime;
    }
    else {
      $windows = $windowsTime / $windowsCount;
    }
    if($iOSCount === 0){
        $iOS = $iOSTime;
    }
    else {
        $iOSTime = $iOSTime / $iOSCount;
    }
    if($androidCount === 0){
        $android = $androidTime; 
    }
    else {
        $android = $androidTime / $androidCount;
    }
    $barArray = array(
        "Macintosh" => $macintosh,
        "Windows" => $windows,
        "iOS" => $iOS,
        "Android" => $android
    );

    $barArrayJSON = json_encode($barArray, JSON_PRETTY_PRINT);
    echo $barArrayJSON;
    $mysqli->close(); 
?>