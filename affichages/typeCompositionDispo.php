<?php
function typeCoupe ($donnee) {
  $type = '';
  if ($donnee == 1) {
    $type = 'Coupette <br  /> 2 boules de Glaces';
  }
  if ($donnee == 2) {
    $type = 'Coupe tradition <br  /> 3 boules de Glaces';
  }
  if ($donnee == 3) {
    $type = 'Coupe au fruits <br  /> 3 boules de Glaces';
  }
  if ($donnee == 4) {
    $type = 'Coupe gourmande';
  }
  if ($donnee == 5) {
    $type = 'Crêpes';
  }
  if ($donnee == 6) {
    $type = 'Crêpes créations';
  }
  return $type;
}
$requetteSQL = "SELECT DISTINCT `typeComposition` FROM `composition` ORDER BY `typeComposition` ASC";
include '../gestionDB/readDB.php';
  $data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
foreach ($dataTraiter as $key) {
  if ($key['typeComposition'] != 0) {
$message = typeCoupe($key['typeComposition']);
  echo '<div class="boxBlack">
    <a class="lienInterne" href="coupesMenuDetail.php?type='.$key['typeComposition'].'">'.$message.'</a>
  </div>';}
}

 ?>
