<?php
function filter($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function checkBirthDate ($data) {
  $date = $data;
  $year = substr($date,0,4);
  $month = substr($date,5,2);
  $day = substr($date,8,2);
  return checkdate($month, $day, $year);
}
function checkemptyData($data) {
  if ($data == '') {
    return header('location: ../index.php');
  }
}
function haschage($data) {
  $option = [ 'cost' => 12];
  $data = password_hash($data, PASSWORD_BCRYPT, $option);
  return $data;
}
function doublon($donnee){
  $serverName = "localhost";
  $userName = "zxbkuypj_karine";
  $password = "W7&nHV)MuHVMg.)&HH";
  $dbName = "zxbkuypj_CDG";
  $requetteSQL = "SELECT `speudo` FROM `users` WHERE `speudo` = :donnee";
  try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $data = $conn->prepare($requetteSQL);
  } catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
  }
  $data->bindParam(':donnee', $donnee);
  $data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
  if (empty($dataTraiter)) {
    return true;
  } else {
    return false;
  }
}
 ?>
