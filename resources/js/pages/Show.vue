<script>
import axios from 'axios';
// se va all/'interno del template dovrò scriverlo dentro data 
import { baseUrl } from '../Functions/data';

 
export default{
  name: 'Show',
  data(){
    return{
      portfolio: {}
    }
  },
  methods:{
    getApi(){
      axios.get(baseUrl + 'portfolios/' + this.$route.params.slug)
        .then(result => {
          console.log(result.data);
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
  <h1>{{ portfolio.title }}</h1>
  <div v-html="portfolio.text"></div>
</template>



<style scoped lang="scss">
  
</style>