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
    <li class="liCoupe">prix {{prix}} €</li>
  </ul></h4>
  <section id="selectionBoule">
    <ul>
      <li class="liSansStyle"><h4>Les coupes que vous avez enregistré :</h4></li>
      <li class="liSansStyle" v-for="element in panier" v-bind:key="element">{{element}} €</li>
    </ul>
    <div v-if="coupe.length < 4" class="flexRows">
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
    <button class="recCreateur" type="button" name="button" v-on:click="del">Vider</button>

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
            selection: '',
            creme: <?php echo $creme; ?>,
            sorbet: <?php echo $sorbet; ?>,
            sup: <?php echo $sup; ?>

          }
        },
        mounted () {
          let sac
          for (var i = 0; i < localStorage.length; i++) {
           sac = localStorage.getItem(localStorage.key(i))
           this.panier.push(sac)
        }
        },
        methods: {
          creationSorbet (nom) {
            this.coupe.push('Sorbet '+nom)
            if (this.coupe.length === 1) {
              this.prix = 2.90
          }
        },
          creationCreme (nom) {
            this.coupe.push('Crème Glacée '+nom)
            if (this.coupe.length === 1) {
              this.prix = 7.00
            }
          },
          supplements (nom) {

            this.coupe.push('Supplément '+nom)
            this.prix +=1
          },
          rec () {
            const KEY = Math.floor(Math.random() * (10000000 - 1 + 1 )) + 1
            this.coupe.push(this.prix)
            localStorage.setItem(KEY, this.coupe)
            location.reload()
          },
          del () {
            localStorage.clear()
            location.reload()
          }
        }
      })

      boule1.mount('#boule1');
  </script>
