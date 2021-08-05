<?php
include 'header.php';
  $requetteSQL = "SELECT `idNavigator`, `lien`, `description`, `acreditation`, `illustration` FROM `navigator` WHERE `acreditation` = 3";
  include 'gestionDB/readDB.php';
  $data->execute();
    $data->setFetchMode(PDO::FETCH_ASSOC);
    $dataTraiter = $data->fetchAll();

 ?>
<section class="hub">
<?php
  foreach ($dataTraiter as $key) {
    echo '<a class="menu" href="rubriques/'.$key['lien'].'"><div class="choix"><h3>'.$key['description'].'</h3></div></a>';
  }
 ?>
</section>
<?php
include 'footer.php';
 ?>
