<?php
  header('Content-type: application/json');
?>
<?php
  $mysqli = new mysqli("localhost", "root", "123", "userdata");

  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  $userData = mysqli_query($mysqli, "SELECT userSessionID, userAgent, userNetworkConnectionType, userScreenDimensions, userLanguages FROM userdata.static");
$user = [];
$deviceType;
if ($userData) {
  while ($userRow = $userData->fetch_assoc()) {
    $userSessionID = $userRow["userSessionID"];
    $userAgent = $userRow["userAgent"];
    $userNetwork = $userRow["userNetworkConnectionType"];
    $userScreenDimensions = $userRow["userScreenDimensions"];
    $userLanguages = $userRow["userLanguages"];
    if (strpos($userAgent, "Android") !== false) {
        $deviceType = "Android";
    } elseif (strpos($userAgent, 'iPhone') !== false) {
        $deviceType = "iOS";
    } elseif (strpos($userAgent, 'Windows') !== false) {
        $deviceType = "Windows";
    } elseif (strpos($userAgent, 'Macintosh') !== false) {
        $deviceType = "Macintosh";
    }
    // Unique Session On Site, 
    // User's Device Type, 
    // User's Network Connection Speed, 
    // User's Screen Dimensions, 
    // User's Languages
    $arr = array(
      "Unique Session On Site" => $userSessionID,
      "User's Device Type" => $deviceType,
      "User's Network Connection Speed" => $userNetwork,
      "User's Screen Dimensions" => $userScreenDimensions,
      "User's Languages" => $userLanguages
    );
    array_push($user, $arr);
  }
  $userData->free();
}
function removeDuplicateArrays($array) {
  $serializedArray = array_map(function($item) {
      return serialize($item);
  }, $array);

  $uniqueSerializedArray = array_unique($serializedArray);

  $uniqueArray = array_map(function($item) {
      return unserialize($item);
  }, $uniqueSerializedArray);

  return array_values($uniqueArray);
}
$userUnique = removeDuplicateArrays($user);
$userJSON = json_encode($userUnique, JSON_PRETTY_PRINT);
echo $userJSON;
$mysqli->close();
?>
