<script>
import axios from 'axios';
import { baseUrl } from '../Functions/data'

export default{
  name: 'Show',
  data(){
    return{
      portfolio: {},
    }
  },
  methods:{
    getApi(){
      axios.get(baseUrl + 'portfolios/' + this.$route.params.slug)
        .then(result => {
          this.portfolio = result.data;
        });
    }
  },
  mounted(){
    this.getApi();
  }
}

</script>

<template>
  <div >
    <h1 v-if="portfolio && portfolio.portfolio">{{ portfolio.portfolio.title }}</h1>
    <div v-if="portfolio && portfolio.portfolio" v-html="portfolio.portfolio.text"></div>
  </div>
</template>

<style scoped lang="scss">
  
</style>