<script>
import axios from 'axios';
import Item from './components/Item.vue';
import { baseUrl } from '../Functions/data';
export default {
  name: 'App',
  components:{
    Item
  },
  data() {
    return {
      // baseUrl è una costante
      baseUrl,
      portfolios: [],
      maxLength: 150,
      pagination: {
        current: 1,
        last: null
      },
    }
  },
  methods: {
    getApi(page) {
      this.pagination.current = page,
        axios.get(this.baseUrl + 'portfolios', {
          params: {
            page: this.pagination.current
          }

        })
          .then((result) => {
            this.portfolios = result.data.portfolios.data;
            this.pagination.current = result.data.portfolios.current_page;
            this.pagination.last = result.data.portfolios.last_page;
          })
    }    
  },
  mounted() {
    this.getApi(1)
  }
}

</script>

<template>
  
  
  <h1>Lista portfolios con vue</h1>
  
  <Item v-for="portfolio in portfolios" :key="portfolio.id" :portfolio="portfolio"/>
    

    <div class="pag">
      <button class="btn btn-info me-1" :disabled="pagination.current === 1" @click="getApi(pagination.current - 1)">
        &larr; </button>

      <button class="btn btn-info me-1" :disabled="pagination.current === i" v-for="i in pagination.last" :key="i"
        @click="getApi(i)">{{ i }}</button>

      <button class="btn btn-info" :disabled="pagination.current === pagination.last"
        @click="getApi(pagination.current + 1)"> &rarr; </button>
    </div>
  
</template>

<style>
  .pag{
    text-align: center;
  }
</style>