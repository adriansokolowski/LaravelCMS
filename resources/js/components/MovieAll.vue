<template>
  <div class="block">
    <div>
      <b-nav class="bhead justify-content-around" pills>
        <b-nav-item :active="tab === 1" @click.prevent="change_sort('created_at'), tab = 1">Ostatnio dodane</b-nav-item>
        <b-nav-item :active="tab === 2" @click.prevent="change_sort('last_view'), tab = 2">Ostatnio oglądane</b-nav-item>
        <b-nav-item :active="tab === 3" @click.prevent="change_sort('views'), tab = 3">Najpopularniejsze</b-nav-item>
      </b-nav>
    </div>
    <div class="bbody">
      <div v-for="movie in movies.data" :key="movie.id" class="item d-flex m-2">
        <div class="poster">
          <img :src="'/storage/poster/'+movie.id+'.jpg'" class="thumb" alt />
        </div>
        <div class="info">
          <a :href="movie.path" title class="font-weight-bold">{{ movie.title }}</a>
          <div class="gen">
            {{ movie.release_date }}
            <a
              v-for="category in movie.categories"
              :key="category.id"
              href="#"
            >{{ category.name }}</a>
          </div>
          <div class="description">{{ movie.description }}</div>
          <p class="bar mb-0">1111 odsłon Lektor Napisy</p>
        </div>
      </div>
      <pagination :data="movies" @pagination-change-page="getResults"></pagination>
    </div>
  </div>
</template> 

<script>
export default {
  data() {
    return {
      tab: 1,
      movies: {},
      sortBy: 'created_at'
    };
  },
  mounted() {
    this.getResults();
  },
  methods: {
    change_sort(field){
      this.sortBy = field;
      this.getResults();
    },
    getResults(page = 1) {
      axios.get("/api/movies?page=" + page
      + '&sortBy=' + this.sortBy
      )
      .then((response) => {
        this.movies = response.data;
      });
    },
  },
};
</script>