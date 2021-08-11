<div id="PANIER">
  <div v-if="nbrArticle > 0">
    <p>Nombre d'article enregistré : {{nbrArticle}} - Total {{totalPanier}} €</p>
      <button class="recCreateur" type="button" name="button" v-on:click="del">Vider panier</button>
      <button v-if="!valide" class="recCreateur" type="button" name="button" v-on:click="valide = true">Valider le panier ?</button>
      <form v-if="valide" class="" action="../formulaires/record/recordCommande.php" method="post">
        <label for="tok">Token de commande</label>
        <input class="sizeInpute" type="text" name="tokenCommande" placeholder="Votre token de commande ?">
        <label for="number">Numéro de commande</label>
        <input class="sizeInpute" type="number" name="id" placeholder="Numéro de votre commande ?">
        <input type="hidden" name="totalPanier" :value="totalPanier">
        <input type="hidden" name="nbrArticle" :value="nbrArticle">
        <input type="hidden" name="panier" :value="panier">
        <button class="recCreateur" type="submit" name="button">Envoyer la commande</button>
      </form>
  </div>
</div>
<script type="text/javascript">
const PANIER = Vue.createApp(
{
  data() {
    return {
      panier: [],
      nbrArticle: 0,
      totalPanier: 0,
      token: '',
      valide: false
    }
  },
mounted () {
  this.nbrArticle = sessionStorage.length
  this.totalPanier = parseFloat(localStorage.getItem('prix'))
  this.totalPanier = this.totalPanier.toFixed(2)
  let sac
  for (var i = 0; i < sessionStorage.length; i++) {
   sac = sessionStorage.getItem(sessionStorage.key(i))
   this.panier.push(sac)
 }
},
methods: {
  del () {
    localStorage.clear()
    sessionStorage.clear()
    location.reload()
  }
  }
})
PANIER.mount('#PANIER');
</script>
