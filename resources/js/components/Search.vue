<template>
  <div class="block text-center mb-1">
    <div class="bhead">
      <a href="/filmy">Filmy</a> |
      <a href="/seriale">Seriale</a>
    </div>
    <div class="bbody">
      <vue-typeahead-bootstrap
        v-model="movie"
        :data="movies"
        @keydown.enter="search"
        :serializer="item => item.title"
        placeholder="Tytuł filmu lub serialu"
        @keyup.enter="handleEnter"
      >
        <template slot="append">
          <button class="btn btn-custom">Szukaj</button>
        </template>
      </vue-typeahead-bootstrap>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movie: null,
      movies: null,
    };
  },
  methods: {
    handleEnter: function (event) {
        console.log(this.movie);
    },
  },
  mounted() {
    axios.get("/api/movies").then((response) => {
      this.movies = response.data.data;
      //   .map((obj) => obj.title);
    });
  },
};
</script>