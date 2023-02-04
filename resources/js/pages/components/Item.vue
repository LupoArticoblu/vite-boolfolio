<script>

import { cutText } from '../../Functions/function';
 export default {
  name: 'Item',
  data(){
    return{
      cutText,
      maxLength: 100
    } 
  },
  props:{
    portfolio: Object
    
  },
  computed:{
    dat(){
      const option = { year: 'numeric', month: 'numeric', day: 'numeric'};
      return new Date(this.portfolio.date).toLocaleDateString('it-IT', option); 
    }
  }
 }
</script>

<template>
  <div class="Elenco">
    <div class="d">
      <h3> <router-link :to="{name : 'Show', params:{ slug: portfolio.slug} }">{{ portfolio.title }}</router-link> </h3> 
      <p>{{ dat }}</p>
    </div>
      <span v-if="portfolio.category" class="badge bg-warning">{{
        portfolio.category.name
      }}</span><span v-for="tag in portfolio.tags" :key="tag.id" class="badge bg-dark">{{ tag.name }}</span>

    <p class="m-0" v-html="cutText(portfolio.text)">
      </p>

  </div>
</template>

<style lang="scss" scoped>
 .Elenco{
  margin-bottom: 12px;
  .d{
    display: flex;
    justify-content: space-between;
  }
 }
 a{
    text-decoration: none;
    color: black;
    &:hover{
      color: black;
    }
  }
</style>