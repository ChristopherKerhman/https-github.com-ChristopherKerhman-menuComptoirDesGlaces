<?php
$requetteSQL = "SELECT `adresse`, `phone`, `siret`, `ouvert` FROM `inc` WHERE 1";
include 'gestionDB/readDB.php';
$data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
 ?>
<footer>
<h4>Le comptoir des glaces</h4>
<ul class="ulFooter">
  <li class="liFooter">Adresse : <?php echo utf8_encode($dataTraiter[0]['adresse']); ?></li>
  <li class="liFooter">Numéro de telephone : <?php echo $dataTraiter[0]['phone']; ?></li>
  <li class="liFooter">Numéro de siret : <?php echo $dataTraiter[0]['siret']; ?></li>
  <li class="liFooter">Ouvert : <?php echo utf8_encode($dataTraiter[0]['ouvert']); ?></li>
</ul>
</footer>
  </body>
</html>
