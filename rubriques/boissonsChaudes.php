<?php
include 'header.php';
// Trie sur les boisson chaudes idTypeProduit (31) -> Correspond à une boisson chaude dans la table produits
$requetteSQL = "SELECT `idProduits`, `nom`, `idTypeProduit`, `stock`, `prixUnitaire` FROM `Produits` WHERE `idTypeProduit` = 31 AND `stock` = 1 ORDER BY `nom` ASC";
include '../gestionDB/readDB.php';
$data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
 ?>
<section>
      <ul class="conteneurListePrix">
          <h3>Boissons chaudes</h3>
        <?php
        foreach ($dataTraiter as $key) {
          echo '<li class="price">'.$key['nom'].' '.$key['prixUnitaire'].' €</li>';
        }
         ?>
      </ul>
    <aside class="menuOnglet">
    <?php
    include '../affichages/menuOnglet.php';
     ?>
   </aside>
</section>
<?php
include 'footer.php';
 ?>
