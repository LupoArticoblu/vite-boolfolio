<script>
import Header from "./pages/partials/Header.vue"

export default {
  name: 'App',
  components: {
    Header
  }
}

</script>

<template>
  <div class="container">

    <Header></Header>

    <main>
      <!-- tutte le viste vue nel router -->
      <router-view></router-view>
    </main>
  </div>
</template>

<style lang="scss" scoped>

</style>