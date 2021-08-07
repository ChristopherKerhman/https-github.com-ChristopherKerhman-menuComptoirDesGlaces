<?php
  include 'header.php';
  $requetteSQL = "SELECT `idProduits`, `nom` FROM `Produits` WHERE `idTypeProduit`= 29 AND `stock`= 1";
  include '../gestionDB/readDB.php';
  $data->execute();
    $data->setFetchMode(PDO::FETCH_ASSOC);
    $dataTraiter = $data->fetchAll();
    $creme = json_encode($dataTraiter);
  $requetteSQL = "SELECT `idProduits`, `nom` FROM `Produits` WHERE `idTypeProduit`= 30 AND `stock`= 1";
  include '../gestionDB/readDB.php';
  $data->execute();
    $data->setFetchMode(PDO::FETCH_ASSOC);
    $dataTraiter = $data->fetchAll();
    $sorbet = json_encode($dataTraiter);
    $requetteSQL = "SELECT `idProduits`, `nom` FROM `Produits` WHERE `idTypeProduit`= 33 AND `stock`= 1";
    include '../gestionDB/readDB.php';
    $data->execute();
      $data->setFetchMode(PDO::FETCH_ASSOC);
      $dataTraiter = $data->fetchAll();
      $sup = json_encode($dataTraiter);
 ?>
  <h2>Créateur 4 boules</h2>
<div id="boule1">
  <h4 class="center">Liste de votre coupe :
    <ul class="ulFooter">
    <li class="liCoupe" v-for="compo in coupe" v-bind:key="compo">{{compo}}</li>
    <li class="liCoupe">prix de la coupe <strong>{{prix}}</strong> €</li>
  </ul></h4>
  <section id="selectionBoule">
    <div v-if="coupe.length < 5" class="flexRows">
      <div>
        <h3>Crème glacée</h3>
          <button class="choixCreateur" type="button" name="button" v-for="boule in creme" v-bind:key="boule" v-on:click="creationCreme(boule.nom)">{{boule.nom}}</button>
      </div>
      <div>
        <h3>Sorbet</h3>
    <button  class="choixCreateur" type="button" name="button" v-for="boule in sorbet" v-bind:key="boule" v-on:click="creationSorbet(boule.nom)">{{boule.nom}}</button>
      </div>
    </div>
    <div class="flexCol">
      <div>
        <h3>Supplément</h3>
    <button  class="choixCreateur" type="button" name="button" v-for="boule in sup" v-bind:key="boule" v-on:click="supplements(boule.nom)">{{boule.nom}}</button>
      </div>
    </div>
    <button class="recCreateur" type="button" name="button" v-on:click="rec">Valider</button>
  </section>
</div>
<!--Partie VueJS -->
 <?php
 include 'footer.php';
  ?>
  <script type="text/javascript">
      const boule1 = Vue.createApp({
        data () {
          return {
            coupe: [],
            prix: 0,
            panier: [],
            total: 0,
            selection: '',
            creme: <?php echo $creme; ?>,
            sorbet: <?php echo $sorbet; ?>,
            sup: <?php echo $sup; ?>

          }
        },
        methods: {
          creationSorbet (nom) {
            this.coupe.push('Sorbet '+nom)
            if (this.coupe.length === 1) {
              this.prix = 8.5
          }
        },
          creationCreme (nom) {
            this.coupe.push('Crème Glacée '+nom)
            if (this.coupe.length === 1) {
              this.prix = 8.5
            }
          },
          supplements (nom) {

            this.coupe.push('Supplément '+nom)
            this.prix +=1
          },
          rec () {
            const KEY = Math.floor(Math.random() * (10000000 - 1 + 1 )) + 1
            this.coupe.push(this.prix)
            sessionStorage.setItem(KEY, this.coupe)
            // Mise à jour du prix du panier
            if (localStorage.getItem('prix') == null) {
              localStorage.setItem('prix', this.prix)
            } else {
              this.total = parseFloat(localStorage.getItem('prix'))
              this.total = this.prix + this.total
              localStorage.setItem('prix', this.total)
            }
            location.reload()
          }
        }
      })

      boule1.mount('#boule1');
  </script>
