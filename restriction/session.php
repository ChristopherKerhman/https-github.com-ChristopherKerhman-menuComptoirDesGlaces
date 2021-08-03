<?php
session_start();
if(!empty($_SESSION)){
if ($_SESSION['role'] < $autorisation) {
  header('location: index.php');
}
}
 ?>
