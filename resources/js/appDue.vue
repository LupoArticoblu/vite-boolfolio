<script>
import axios from 'axios';

export default {
  name: 'App',
  data() {
    return {
      baseUrl: 'http://127.0.0.1:8000/api/',
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
    },
    cutText(text) {
      if (text.length > this.maxLength) {
        return text.substr(0, this.maxLength) + '...';
      }
    }
  },
  mounted() {
    this.getApi(1)
  }
}

</script>

<template>
  

    
    <h1>Lista portfolios con vue</h1>

    <div class="elenco" v-for="portfolio in portfolios" :key="portfolio.id">
      <h3>{{ portfolio.title }}</h3> <span v-if="portfolio.category" class="badge bg-warning">{{
        portfolio.category.name
      }}</span><span v-for="tag in portfolio.tags" :key="tag.id" class="badge bg-dark">{{ tag.name }}</span>

      <p class="m-0" v-html="cutText(portfolio.text)">
      </p>

    </div>

    <div class="pag">
      <button class="btn btn-primary me-1" :disabled="pagination.current === 1" @click="getApi(pagination.current - 1)">
        &larr; </button>

      <button class="btn btn-primary me-1" :disabled="pagination.current === i" v-for="i in pagination.last" :key="i"
        @click="getApi(i)">{{ i }}</button>

      <button class="btn btn-primary" :disabled="pagination.current === pagination.last"
        @click="getApi(pagination.current + 1)"> &rarr; </button>
    </div>
  
</template>

<style>

</style>