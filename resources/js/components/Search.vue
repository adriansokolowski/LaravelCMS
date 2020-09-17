<template>
  <div class="block text-center mb-1">
    <div class="bhead">
      <a href="/filmy">Filmy</a> |
      <a href="/seriale">Seriale</a>
    </div>
    <div class="bbody">
      <!-- <v-toolbar flat class="ma-0 pa-0"> -->
      <v-autocomplete
        background-color="#F3E7E0"
        v-model="select"
        :loading="loading"
        :items="movies"
        item-text="title"
        item-value="title"
        :search-input.sync="search"
        class="ma-0 pa-0"
        flat
        hide-no-data
        hide-details
        label="Tytuł filmu lub serialu"
        solo
      >
        <template v-slot:item="{ item }">
          <a :href="'/film/'+item.id">
          <v-img max-width="75" :src="'/storage/poster/'+item.id+'.jpg'"></v-img>
          <span>{{ item.title }}</span>
          <span>{{ item.release_date }}</span></a>
        </template>
        <template v-slot:append>
          <v-btn depressed dark color="#a49484" class="ma-0 text-capitalize" @click="show">Szukaj</v-btn>
        </template>
      </v-autocomplete>
      <!-- </v-toolbar> -->
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