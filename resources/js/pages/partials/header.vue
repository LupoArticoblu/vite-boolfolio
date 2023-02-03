<script>
  export default{
    // ricorda: vue è key sensitive ed un componente non va assolutamente scritto come un tag
    name: 'Header'
}
</script>

<template>
  <header>
    <ul >
      <!-- router-link è solo un tag link in cui bindare to e passargli in oggetto il nome delle rotte -->
      <li><router-link class="btn btn-outline-info" :to="{name: 'home'}">Home</router-link></li>
      <li><router-link class="btn btn-outline-info" :to="{name: 'Recenti'}">Recenti</router-link></li>
      <li><router-link class="btn btn-outline-info" :to="{name: 'About'}">Chi siamo?</router-link></li>
      <li><router-link class="btn btn-outline-info" :to="{name: 'contacts'}">Contattaci</router-link></li>
      
    </ul>
  </header>

</template>

<style lang="scss" scoped>
  header{
    text-align: center;
    ul{
      list-style: none;
      padding: 0 0 0 28px;
      li{
        display: inline-block;
        margin: 0 10px;
        text-decoration: none;
        router-link{
          text-decoration: none;
        }

      }
    }
  }
</style>