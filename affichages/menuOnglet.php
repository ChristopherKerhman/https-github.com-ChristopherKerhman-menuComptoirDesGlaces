<ul class="ulOnglet">
  <?php
    $requetteSQL = "SELECT `idNavigator`, `lien`, `description`, `acreditation`, `illustration` FROM `navigator` WHERE `acreditation` = 3";
    include '../gestionDB/readDB.php';
    $data->execute();
      $data->setFetchMode(PDO::FETCH_ASSOC);
      $dataTraiter = $data->fetchAll();
      foreach ($dataTraiter as $key) {
        echo '<li class="liOnglet"><a class="lienNav" href="'.$key['lien'].'">'.$key['description'].'</a></li>';
      }
   ?>

</ul>
