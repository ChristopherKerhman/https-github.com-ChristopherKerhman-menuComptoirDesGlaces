<?php
$type = $_GET['type'];
include 'header.php';
$requetteSQL = "SELECT * FROM `composition` WHERE `typeComposition` ={$type}";
include '../gestionDB/readDB.php';
$data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
  function typeCoupe ($donnee) {
    $type = '';
    if ($donnee == 1) {
      $type = 'Coupette';
    }
    if ($donnee == 2) {
      $type = 'Coupe tradition';
    }
    if ($donnee == 3) {
      $type = 'Coupe au fruits';
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
 ?>
<section class="Zmoins">
  <article>
<ul class="conteneurListePrix">
  <h3><?php echo typeCoupe($type);  ?></h3>
<?php
foreach ($dataTraiter as $key) {
  //Mettre le chemin absolue pour la version prod
  echo '<li class="price"><img src="https://bocdg.christophe.kerman.go.yj.fr/compositionImages/'.$key['image'].'" alt="'.$key['nomComposition'].'"><br />
  '.$key['nomComposition'].' Prix '.$key['prixComposition'].'
  <form class="" action="coupeSolo.php" method="post">
    <input type="hidden" name="idC" value="'.$key['idComposition'].'">
    <button class="choixCreateur" type="submit" name="button">Voir détail</button>
  </form>
</li>';
}
 ?>
</ul>
  </article>
</section>
<?php
include 'footer.php';
 ?>
