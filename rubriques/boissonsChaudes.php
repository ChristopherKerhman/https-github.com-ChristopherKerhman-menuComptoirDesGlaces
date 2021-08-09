<?php
include 'header.php';
// Trie sur les boisson chaudes idTypeProduit (31) -> Correspond à une boisson chaude dans la table produits
$requetteSQL = "SELECT `idProduits`, `nom`, `prixUnitaire` FROM `Produits` WHERE `idTypeProduit` = 31 AND `stock` = 1 ORDER BY `nom` ASC";
include '../gestionDB/readDB.php';
$data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
  $hot = json_encode($dataTraiter);
 ?>
<section>
  <article>
    <ul class="conteneurListePrix">
      <h3>Boissons chaudes</h3>
      <div id="HOT">
        <li class="price" v-for="chaudes in hot" v-bind:key="chaudes"><button class="choixCreateur" type="button" name="button" v-on:click="rec(chaudes.nom, chaudes.prixUnitaire)">Commander</button>{{chaudes.nom}} {{chaudes.prixUnitaire}} €</li>
      </div>
    </ul>
  </article>
<aside class="menuOnglet"></li>
    <?php
    include '../affichages/menuOnglet.php';
     ?>
   </aside>
</section>
<script type="text/javascript">
  const HOT = Vue.createApp({
    data () {
      return {
      hot: <?php echo $hot; ?>
      }
    },
    methods: {
      rec (nom, prix) {
        let price = parseFloat(prix)
        const KEY = Math.floor(Math.random() * (10000000 - 1 + 1 )) + 1
        sessionStorage.setItem(KEY, nom +' '+ price)
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
  HOT.mount('#HOT')
</script>
<?php
include 'footer.php';
 ?>
