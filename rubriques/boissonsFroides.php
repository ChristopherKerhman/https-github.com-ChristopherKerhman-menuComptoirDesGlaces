<?php
include 'header.php';
// Trie sur les boisson chaudes idTypeProduit (31) -> Correspond à une boisson chaude dans la table produits
$requetteSQL = "SELECT `idProduits`, `nom`, `prixUnitaire` FROM `Produits` WHERE `idTypeProduit` = 32 AND `stock` = 1 ORDER BY `nom` ASC";
include '../gestionDB/readDB.php';
$data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
  $dataTraiter = $data->fetchAll();
  $cold = json_encode($dataTraiter);
 ?>
 <section>
       <ul class="conteneurListePrix">
           <h3>Boissons fraîches</h3>
           <div id="COLD">
             <li class="price" v-for="froides in cold" v-bind:key="froides"><button class="choixCreateur" type="button" name="button" v-on:click="rec(froides.nom, froides.prixUnitaire)">Commander</button>{{froides.nom}} {{froides.prixUnitaire}} €</li>
           </div>
       </ul>
     <aside class="menuOnglet">
     <?php
     include '../affichages/menuOnglet.php';
      ?>
    </aside>
    <script type="text/javascript">
    const COLD = Vue.createApp({
      data () {
        return {
          cold: <?php echo $cold; ?>
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
  COLD.mount('#COLD')
    </script>
 </section>

<?php
include 'footer.php';
 ?>
