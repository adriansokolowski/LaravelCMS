<template>
  <div class="block">
    <div>
      <b-tabs nav-class="bhead justify-content-around" pills>
        <b-tab title="Ostatnio dodane" active>
          <b-card-text>
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
          </b-card-text>

        </b-tab>
        <b-tab title="Ostatnio oglądane">
          <b-card-text>Tab contents 2</b-card-text>
        </b-tab>
        <b-tab title="Najpopularniejsze">
          <b-card-text>Tab contents 2</b-card-text>
        </b-tab>
      </b-tabs>
    </div>
    <div class="bbody"></div>
  </div>
</template> 

<script>
export default {
  data() {
    return {
      movies: {}
    };
  },
  mounted() {
    this.getResults();
  },
  methods: {
    getResults(page = 1) {
      axios.get("/api/movies?page=" + page).then((response) => {
        this.movies = response.data;
      });
    },
  },
};
</script>