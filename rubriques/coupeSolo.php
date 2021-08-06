<?php
include 'header.php';
include '../gestionDB/identifiantDB.php';
// Réception information via formulaires
function filter($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = filter($_POST['idC']);
  $requetteSQL = "SELECT `recette`.`nombre`,`composition`.`image`, `composition`.`nomComposition`, `composition`.`prixComposition`, `Produits`.`nom`  FROM `composition` INNER JOIN `recette` INNER JOIN `Produits` WHERE `composition`.`idComposition` = `recette`.`idCompositionRecette`
  AND `recette`.`idProduitRecette` = `Produits`.`idProduits` AND `Produits`.`stock`= 1 AND `composition`.`idComposition` = :idC";
  include '../gestionDB/readDB.php';
  $data->bindParam(':idC', $id);
  $data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
} else {
  header('location: ../index.php');
}

 ?>
<section>
  <ul>
    <?php
    $name = $dataTraiter[0]['nomComposition'];
    //Permet d'encoder les ' des titres des glaces.
    $pattern = "/'/i";
    $name = preg_replace($pattern, "\'", $name);
    // Fin
    $price = $dataTraiter[0]['prixComposition'];
    echo '<h3>'.$dataTraiter[0]['nomComposition'].' '.$dataTraiter[0]['prixComposition'].' €</h3><br />
    <img src="../compositionImages/'.$dataTraiter[0]['image'].'" alt="'.$dataTraiter[0]['nomComposition'].'"><br />';
    foreach ($dataTraiter as $key) {
      echo $key['nombre'].' '.$key['nom'].', ';
    }
     ?>
<div id="COUPEMENU">
  <li><button class="choixCreateur" type="button" name="button" v-on:click="rec(nomCoupe, prixUnitaire)">Commander {{nomCoupe}} {{prixUnitaire}} €</button></li>
</div>
    </ul>
  <aside class="menuOnglet">
  <?php
  include '../affichages/menuOnglet.php';
  ?>
  </aside>
  <script type="text/javascript">
  const COUPEMENU = Vue.createApp({
    data () {
      return {
        nomCoupe: '<?php echo $name; ?>',
        prixUnitaire: <?php echo $price ?>
      }
    },
    methods: {
      rec (nom, prix) {
        prix = parseFloat(prix)
        // 1 chances sur 10 millions de tombé sur une clé identique pour le panier.
        const KEY = Math.floor(Math.random() * (10000000 - 1 + 1 )) + 1
        sessionStorage.setItem(KEY,'Cocktail '+nom +' '+ prix)
        // Mise à jour du prix du panier
        if (localStorage.getItem('prix') == null) {
          localStorage.setItem('prix', prix)
        } else {
          let total = parseInt(localStorage.getItem('prix'))
          total = prix + total
          localStorage.setItem('prix', total)
        }
        location.reload()
      }
    }
  })
  COUPEMENU.mount('#COUPEMENU')
  </script>

</section>
<?php
include 'footer.php';

 ?>
