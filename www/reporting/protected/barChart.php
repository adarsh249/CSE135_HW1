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
    $windows3GTime = 0;
    $windows4GTime = 0;
    $macintosh3GTime = 0;
    $macintosh4GTime = 0;
    $windows3GCount = 0;
    $windows4GCount = 0;
    $macintosh3GCount = 0;
    $macintosh4GCount = 0;
    $iOS3GCount = 0;
    $iOS3GTime = 0;
    $iOS4GCount = 0;
    $iOS4GTime = 0;
    $android3GCount = 0;
    $android3GTime = 0;
    $android4GCount = 0;
    $android4GTime = 0;

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
              else if(strpos($userAgent, "iPhone") !== false) {
                if($networkConnectionType === "3g"){
                    $iOS3GCount++;
                    $iOS3GTime += $pageLoadTime;
                }
                else if($networkConnectionType === "4g") {
                    $iOS4GCount++;
                    $iOS4GTime += $pageLoadTime;
                }
              }
              else if(strpos($userAgent, "Android") !== false){
                if($networkConnectionType === "3g"){
                    $android3GCount++;
                    $android3GTime += $pageLoadTime;
                }
                else if($networkConnectionType === "4g"){
                    $android4GCount++;
                    $android4GTime += $pageLoadTime;
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
    $iOS3G = 0;
    $iOS4G = 0;
    $android3G = 0;
    $android4G = 0;
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
    if($iOS3GCount === 0){
        $iOS3G = $iOS3GTime;
    }
    else {
        $iOS3GTime = $iOS3GTime / $iOS3GCount;
    }
    if($iOS4GCount === 0) {
        $iOS4G = $iOS4GTime;
    }
    else {
        $iOS4G = $iOS4GTime / $iOS4GCount;
    }
    if($android3GCount === 0){
        $android3G = $android3GTime; 
    }
    else {
        $android3G = $android3GTime / $android3GCount;
    }
    if($android4GCount === 0) {
        $android4G = $android4GTime;
    }
    else {
        $android4G = $android4GTime / $android4GCount;
    }
    
    $barArray = array(
        "Macintosh3G" => $macintosh3G,
        "Macintosh4G" => $macintosh4G,
        "Windows3G" => $windows3G,
        "Windows4G" => $windows4G,
        "iOS3G" => $iOS3G,
        "iOS4G" => $iOS4G,
        "Android3G" => $android3G,
        "Android4G" => $android4G
    );

    $barArrayJSON = json_encode($barArray, JSON_PRETTY_PRINT);
    echo $barArrayJSON;
    $mysqli->close(); 
?>