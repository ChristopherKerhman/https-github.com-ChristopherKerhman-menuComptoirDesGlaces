<?php
  include 'header.php';
  $requetteSQL = "SELECT `idProduits`, `nom` FROM `Produits` WHERE `idTypeProduit`= 29 AND `stock`= 1";
  include '../gestionDB/readDB.php';
  $data->execute();
    $data->setFetchMode(PDO::FETCH_ASSOC);
    $dataTraiter = $data->fetchAll();
    $creme = json_encode($dataTraiter);
 ?>
<section>
<div id="MilkShake" class="size50">
<article>
    <h4 class="center">Créateur de Milkshakes - Prix : {{prix}} €</h4>
    <ul class="ulFooter">
      <li class="liCoupe" v-for="compo in milkShake" v-bind:key="compo">{{compo}}</li>
    <li class="liCoupe" v-if="sup">Supplément chantilly</li>
  </ul>
  <strong v-if="milkShake.length > 1" v-on:click="supprimer(compo)">Supprimer le milkshake ?</strong>
  <div v-if="prix ==  0">
    <button class="choixCreateur" type="button" name="button" v-on:click="dimension(false)">Grand 5.90 €</button>
    <button class="choixCreateur" type="button" name="button" v-on:click="dimension(true)">petit 4.50 €</button>
  </div>
    <button v-if="!sup && prix > 0" class="choixCreateur" type="button" name="button" v-on:click="supplement(true)">Supplément chantilly 0.50 €</button>
    <button v-if="sup && prix > 0" class="choixCreateur" type="button" name="button" v-on:click="supplement(false)">Retirer le supplément chantilly</button>
    <div  class="flexrows" v-if="milkShake.length < 3" >
      <h3>Choix de une ou deux crème glacée</h3>
        <button class="choixCreateur" type="button" name="button" v-for="boule in creme" v-bind:key="boule" v-on:click="creationCreme(boule.nom)">{{boule.nom}}</button>
    </div>
    <div class="center">
      <button v-if="milkShake.length >= 2 && valide" class="recCreateur" type="button" name="button" v-on:click="rec">Ajouter</button>
    </div>
  </article>
</div>
</section>
<?php
include 'footer.php';
 ?>
<script type="text/javascript">
  const MilkShake = Vue.createApp({
  data () {
      return {
        valide: false,
        prix: 0,
        total:0,
        sup: false,
        yogourt: false,
        milkShake: ['Milkshake'],
        creme: <?php echo $creme; ?>
      }
  },
  methods: {
    supprimer () {
      location.reload(true)
  },
  dimension (volume) {
    this.valide = true
    if(volume) {
      this.prix = 4.5
    }
    if(!volume){
      this.prix = 5.9
    }
  },
  supplement (chan) {
    if (chan) {
      this.sup = true
      this.prix = this.prix + 0.5
    }
    if (!chan) {
      this.sup = false
      this.prix = this.prix - 0.5
    }
  },
  creationCreme (nom) {
    this.milkShake.push(' Crème Glacée '+nom)
  },
  rec () {
    const KEY = Math.floor(Math.random() * (10000000 - 1 + 1 )) + 1

    if(this.sup){
      this.milkShake.push('Supplément chantilly')
    }
      this.milkShake.push(this.prix)
    sessionStorage.setItem(KEY, this.milkShake)
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
  MilkShake.mount('#MilkShake')
</script>
