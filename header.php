<?php
include 'restriction/session.php';
require_once 'gestionDB/identifiantDB.php';
$titre = 'Le menu du comptoir des glaces';
$sous_titre = 'Glacier, crêperie, Salon de thé';
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <title> <?php echo $titre; ?> </title>
  </head>
  <body>
<header>
  <h1><?php echo $titre; ?></h1>
  <h2><?php echo $sous_titre; ?></h2>
</header>
