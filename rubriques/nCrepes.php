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
  <h3>Créateur de crêpes sucré</h3>
<section>
<div id="boule1" >
  <h4 class="center">Liste des éléments de votre crêpes :
    <ul class="ulFooter">
    <li class="liCoupe" v-for="compo in coupe" v-bind:key="compo">{{compo}}</li>
    <li class="liCoupe">Prix de la crêpe <strong> {{prix.toFixed(2)}} €</strong></li>
  </ul>
    <strong v-if="coupe.length > 1" v-on:click="supprimer(compo)">Supprimer la crêpe ?</strong>
</h4>
  <article id="selectionBoule">
    <div class="flexRows">
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
      <div class="center">
        <button v-if="coupe.length >= 1" class="recCreateur" type="button" name="button" v-on:click="rec">Ajouter</button>
      </div>
    </div>
  </article>
</div>
</section>
 <?php
 include 'footer.php';
  ?>
  <script type="text/javascript">
      const boule1 = Vue.createApp({
        data () {
          return {
            totalBoules: 0,
            coupe: ['Crêpes nature'],
            prix: 3.50,
            panier: [],
            total: 0,
            selection: '',
            creme: <?php echo $creme; ?>,
            sorbet: <?php echo $sorbet; ?>,
            sup: <?php echo $sup; ?>

          }
        },
        methods: {
          supprimer () {
            location.reload(true)
        },
          creationSorbet (nom) {
            this.coupe.push('Sorbet '+nom)
              this.prix += 2.3
        },
          creationCreme (nom) {
            this.coupe.push('Crème Glacée '+nom)
              this.prix += 2.3
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
