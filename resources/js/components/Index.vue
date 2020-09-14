<template>
  <div class="block">
    <div class="bhead">
      <v-chip-group column mandatory>
        <v-row justify="space-around">
          <v-chip @click="changeSort('created_at')" label link>Ostatnio dodane</v-chip>
          <v-chip @click="changeSort('last_view')" label link>Ostatnio oglądane</v-chip>
          <v-chip @click="changeSort('views')" label link>Najpopularniejsze</v-chip>
        </v-row>
      </v-chip-group>
    </div>
    <!-- <b-nav class="bhead" pills>
      <b-nav-item
        :active="activeTab === 1"
        @click.prevent="changeSort('created_at'), activeTab = 1"
      >Ostatnio dodane</b-nav-item>
      <b-nav-item
        :active="activeTab === 2"
        @click.prevent="changeSort('last_view'), activeTab = 2"
      >Ostatnio oglądane</b-nav-item>
      <b-nav-item
        :active="activeTab=== 3"
        @click.prevent="changeSort('views'), activeTab = 3"
      >Najpopularniejsze</b-nav-item>
    </b-nav>-->
    <div class="bbody">
      <p v-if="activeTab === 1" class="bar mb-0 text-center">
        Aktualnie przeglądasz
        <b>ostatnio dodane</b> filmy.
      </p>
      <p v-if="activeTab === 2" class="bar mb-0 text-center">
        Aktualnie przeglądasz
        <b>ostatnio oglądane</b> filmy.
      </p>
      <p v-if="activeTab === 3" class="bar mb-0 text-center">
        Aktualnie przeglądasz
        <b>najpopularniejsze</b> filmy.
      </p>

      <div v-for="movie in movies.data" :key="movie.id" class="item d-flex m-2">
        <div class="poster">
          <img :src="'/storage/poster/'+movie.id+'.jpg'" class="thumb" alt />
        </div>
        <div class="info2">
          <a :href="movie.path" title class="font-weight-bold">{{ movie.title }}</a>
          <div class="gen">
            <a :href="'/filmy?year=' + movie.release_date">{{ movie.release_date }}</a> |
            <a
              v-for="(category, index) in movie.categories"
              :key="category.id"
              :href="'/filmy?category=' + category.name"
            >
              <span v-if="index != 0">,</span>
              <span>{{ category.name }}</span>
            </a>
            |
            <a
              v-for="country in movie.countries"
              :key="country.id"
              :href="'/filmy?country=' + country.name"
            >{{ country.name }}</a>
          </div>
          <div class="description">{{ movie.description }}</div>
          <p class="bar pl-1 pr-1 mb-0 d-flex justify-content-between">
            <span>{{ movie.views }} wyświetleń</span>
            <span>
              <v-icon small dark>mdi-microphone</v-icon>
              <v-icon small dark>mdi-earth</v-icon>
              <v-icon small dark>mdi-format-align-left</v-icon>
            </span>
          </p>
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
      activeTab: 1,
      movies: {},
      sortBy: "created_at",
    };
  },
  mounted() {
    this.getResults();
    this.$vuetify.theme.dark = false;
  },
  methods: {
    changeSort(field) {
      this.sortBy = field;
      this.getResults();
    },
    getResults(page = 1) {
      axios
        .get("/api/movies?page=" + page + "&sortBy=" + this.sortBy)
        .then((response) => {
          this.movies = response.data;
        });
    },
  },
};
</script>