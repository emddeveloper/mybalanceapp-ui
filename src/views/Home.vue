<template>
  <div class="home">
    <BalanceForm mtitle="My Balance App"/>
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
