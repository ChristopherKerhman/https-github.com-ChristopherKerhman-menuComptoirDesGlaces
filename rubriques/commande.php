<?php
include 'header.php';
?>

<div id="LISTE">
  <ul v-if="panier.length > 0">
    <li v-for="article in panier" v-bind:key="article">{{article}} €</li>
    <li>Total : {{total}} €</li>
  </ul>

</div>
<script type="text/javascript">
const LISTE = Vue.createApp(
  {
  data() {
    return {
      panier: [],
      total: 0
    }
  },
  mounted () {
    let sac
    for (var i = 0; i < sessionStorage.length; i++) {
     sac = sessionStorage.getItem(sessionStorage.key(i))
     this.panier.push(sac)
   }
   this.total = parseFloat(localStorage.getItem('prix'))
   this.total = this.total.toFixed(2)
  }
})
LISTE.mount('#LISTE');
</script>
<?php
include 'footer.php';
  ?>
