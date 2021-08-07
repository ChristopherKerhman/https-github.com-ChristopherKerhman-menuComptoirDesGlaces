
<div id="PANIER">
  <div v-if="nbrArticle > 0">
    <p>Nombre d'article enregistré : {{nbrArticle}} - Total {{totalPanier}} €</p>
      <button class="recCreateur" type="button" name="button" v-on:click="del">Vider panier</button>
  </div>
</div>
<script type="text/javascript">
const PANIER = Vue.createApp(
  {
    data() {
      return {
        nbrArticle: 0,
        totalPanier: 0
      }
    },
    mounted () {
      this.nbrArticle = sessionStorage.length
      this.totalPanier = parseFloat(localStorage.getItem('prix'))
      this.totalPanier = this.totalPanier.toFixed(2)

    },
    methods: {
      del () {
        localStorage.clear()
        sessionStorage.clear()
        location.reload()
      }
    }
  }
)
PANIER.mount('#PANIER');
</script>
