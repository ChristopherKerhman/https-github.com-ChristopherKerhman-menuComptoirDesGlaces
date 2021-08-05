<?php
include '../restriction/session.php';
require_once '../gestionDB/identifiantDB.php';
$titre = 'Le menu du comptoir des glaces';
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/master.css">
      <script src="https://unpkg.com/vue@next"></script>
    <title> <?php echo $titre; ?> </title>
  </head>
  <body>
<header>
  <h1><?php echo $titre; ?></h1>
</header>
