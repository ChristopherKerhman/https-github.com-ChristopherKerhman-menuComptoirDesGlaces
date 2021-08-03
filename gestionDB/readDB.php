<?php
// Permet de créer une accés à la DB.
try {
  $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = $conn->prepare($requetteSQL);
} catch(PDOException $e) {
 echo "Error: " . $e->getMessage();
}
 ?>
