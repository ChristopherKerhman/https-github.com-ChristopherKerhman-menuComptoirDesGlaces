<?php
include 'header.php';
$requetteSQL = "SELECT * FROM `composition`";
include '../gestionDB/readDB.php';
$data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
 ?>
<section>
<ul>
  <h3>Les coupes</h3>

<?php
foreach ($dataTraiter as $key) {
  //Mettre le chemin absolue pour la version prod
  echo '<li class="price"><img src="../compositionImages/'.$key['image'].'" alt="'.$key['nomComposition'].'"><br />
  '.$key['nomComposition'].' Prix '.$key['prixComposition'].'
  <form class="" action="coupeSolo.php" method="post">
    <input type="hidden" name="idC" value="'.$key['idComposition'].'">
    <button class="choixCreateur" type="submit" name="button">Voir détail</button>
  </form>
</li>';
}
 ?>
</ul>
</section>
<?php
include 'footer.php';
 ?>
