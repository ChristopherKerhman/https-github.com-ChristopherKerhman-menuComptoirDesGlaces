<?php
include 'header.php';
// Trie sur les boisson chaudes idTypeProduit (31) -> Correspond à une boisson chaude dans la table produits
$requetteSQL = "SELECT `idProduits`, `nom`, `prixUnitaire`, `composition` FROM `Produits` WHERE `idTypeProduit` = 40 AND `stock` = 1 ORDER BY `nom` ASC";
include '../gestionDB/readDB.php';
$data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
  $cocktail = json_encode($dataTraiter);
 ?>
<section>
  <article>
    <ul id="listeCocktails">
        <h3>Coktails</h3>
        <div id="COCKTAIL">
          <li class="price" v-for="sansAlcool in cocktail" v-bind:key="sansAlcool"><button class="choixCreateur" type="button" name="button" v-on:click="rec(sansAlcool.nom, sansAlcool.prixUnitaire)">Commander</button><strong>{{sansAlcool.nom}}</strong>
          {{sansAlcool.prixUnitaire}} €<br />
          {{sansAlcool.composition}}
          </li>
        </div>
    </ul>
  </article>
<aside class="menuOnglet">
<?php
include '../affichages/menuOnglet.php';
?>
</aside>
   <script type="text/javascript">
     const COCKTAIL = Vue.createApp({
       data () {
         return {
           cocktail: <?php echo $cocktail ?>
         }
       },
       methods: {
         rec (nom, prix) {
          let price = parseFloat(prix)
           const KEY = Math.floor(Math.random() * (10000000 - 1 + 1 )) + 1
           sessionStorage.setItem(KEY,'Cocktail '+nom +' '+ price)
           // Mise à jour du prix du panier
           if (localStorage.getItem('prix') == null) {
             localStorage.setItem('prix', price)
           } else {
             let total = parseFloat(localStorage.getItem('prix'))
             total = price + total
             localStorage.setItem('prix', total)
           }
           location.reload()
         }
       }
     })
     COCKTAIL.mount('#COCKTAIL')
   </script>
</section>
<?php
include 'footer.php';
 ?>
