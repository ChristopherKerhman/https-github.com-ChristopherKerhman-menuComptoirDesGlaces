<?php
include '../../restriction/session.php';
include '../../gestionDB/identifiantDB.php';
include '../functionsFormulaire.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$id = filter($_POST['id']);
$token = filter($_POST['tokenCommande']);
$totalPanier = filter($_POST['totalPanier']);
$nbrArticle = filter($_POST['nbrArticle']);
$panier = filter($_POST['panier']);
$requetteSQL = "SELECT `tokenCommande` FROM `commandesClients` WHERE `valide`= 1";
include '../../gestionDB/readDB.php';
$data->execute();
$data->setFetchMode(PDO::FETCH_ASSOC);
$dataToken = $data->fetchAll();
foreach ($dataToken as $key) {
  if ($key['tokenCommande'] == $token) {
    $requetteSQL = "UPDATE `commandesClients` SET `totalPanier`=:totalPanier,`nbrArticle`=:nbrArticle,`panier`=:panier, `valide`= 2 WHERE `id` = :id";
    include '../../gestionDB/readDB.php';
    $data->bindParam(':id', $id);
    $data->bindParam(':totalPanier', $totalPanier);
    $data->bindParam(':nbrArticle', $nbrArticle);
    $data->bindParam(':panier', $panier);
    $data->execute();
      header('location:../../index.php');
  } else {
    header('location:../../index.php');
  }
}
} else {
  header('location:../../index.php');
}
 ?>
