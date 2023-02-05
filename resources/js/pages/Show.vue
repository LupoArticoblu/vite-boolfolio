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
          console.log(result.data);
          console.log('->' + this.$route.params.slug);
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
    <div v-if="portfolio && portfolio.portfolio">categoria:{{ portfolio.portfolio.category.name }}</div>
    <div v-if="portfolio && portfolio.portfolio">
      <span v-for="tag in portfolio.portfolio.tags" :key="tag.id">
        {{ tag.name }}
      </span>
    </div>
    <div v-if="portfolio && portfolio.portfolio" >
      <img :src="portfolio.portfolio.image" :alt="portfolio.portfolio.title">
    </div>
    <div v-if="portfolio && portfolio.portfolio" v-html="portfolio.portfolio.text"></div>
  </div>
</template>

<style scoped lang="scss">
  
</style>