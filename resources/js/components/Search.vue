<template>
  <div class="block text-center mb-1">
    <div class="bhead">
      <a href="/filmy">Filmy</a> |
      <a href="/seriale">Seriale</a>
    </div>
    <div class="bbody">
      <v-toolbar flat class="ma-0 pa-0">
        <v-autocomplete
          background-color="#F3E7E0"
          v-model="select"
          :loading="loading"
          :items="items"
          :search-input.sync="search"
          cache-items
          full-width
          height="11"
          class="ma-0 pa-0 mr-4"
          flat
          hide-no-data
          hide-details
          label="Tytuł filmu lub serialu"
          solo
        ></v-autocomplete>
        <v-btn color="#a49484" dark>Szukaj</v-btn>
      </v-toolbar>
      <!-- <vue-typeahead-bootstrap
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
      </vue-typeahead-bootstrap>-->
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