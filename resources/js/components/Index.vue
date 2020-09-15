<template>
  <div class="block">
    <div class="bhead">
      <v-chip-group column mandatory>
        <v-row justify="space-around">
          <v-chip
            v-for="sortType in sorts"
            :key="sortType.value"
            @click="changeSort(sortType)"
            label
            link
          >{{sortType.text}}</v-chip>
        </v-row>
      </v-chip-group>
    </div>
    <div class="bbody">
      <v-skeleton-loader :loading="loading" tile type="list-item-avatar-three-line@4">
        <p class="bar mb-0 text-center">
          Aktualnie przeglądasz
          <b>{{ text }}</b> filmy.
        </p>
        <div v-for="movie in movies" :key="movie.id" class="item d-flex m-2">
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
              <v-spacer></v-spacer>
              <span>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on, attrs }">
                    <v-icon small dark v-bind="attrs" v-on="on">mdi-volume-medium</v-icon>
                  </template>
                  <span>Dubbing</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on, attrs }">
                    <v-icon small dark v-bind="attrs" v-on="on">mdi-microphone</v-icon>
                  </template>
                  <span>Lektor</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on, attrs }">
                    <v-icon small dark v-bind="attrs" v-on="on">mdi-earth</v-icon>
                  </template>
                  <span>ENG</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on, attrs }">
                    <v-icon small dark v-bind="attrs" v-on="on">mdi-format-align-left</v-icon>
                  </template>
                  <span>Napisy</span>
                </v-tooltip>
              </span>
            </p>
          </div>
        </div>
        <pagination :data="movies" @pagination-change-page="getResults"></pagination>
      </v-skeleton-loader>
    </div>
  </div>
</template> 

<script>
export default {
  data: () => ({
    movies: {},
    loading: true,
    text: "ostatnio dodane",
    sortBy: "created_at",
    sorts: [
      {
        text: "ostatnio dodane",
        value: "created_at",
      },
      {
        text: "ostatnio oglądane",
        value: "last_view",
      },
      {
        text: "najpopularniejsze",
        value: "views",
      },
    ],
  }),
  mounted() {
    this.getResults();
  },
  methods: {
    changeSort(sortType) {
      this.sortBy = sortType.valu;
      this.text = sortType.text;
      this.getResults();
    },
    getResults(page = 1) {
      this.loading = true;
      axios
        .get("/api/movies?page=" + page + "&sortBy=" + this.sortBy)
        .then((response) => {
          this.movies = response.data.data;
          this.loading = false;
        });
    },
  },
};
</script>