<template>
  <div class="home">
    <BalanceForm mtitle="Mind Your Balance"/>
  </div>
</template>

<script>
// @ is an alias to /src
import BalanceForm from '../components/BalanceForm.vue'

export default {
  name: 'Home',
  components: {
    BalanceForm
  }
}
</script>
<style>
.loader{
	width: 100%;
    height: 100%;
    top: 0;
    padding: 0;
    left: 0;
    margin: 0;
    background: rgba(0, 0, 0, 0.3);
    position: fixed;
    z-index: 100;
    bottom: 0;
    right: 0;
}
.loader>img{
	    top: 43vh;
    position: absolute;
    background: #17a2b817
}
</style>