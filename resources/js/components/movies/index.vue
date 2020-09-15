<template>
  <div>
    <div class="block">
      <div class="bhead text-center">Filtry</div>
      <div class="bbody">
        {{ fields }}
        <span>Gatunek:</span>
        <select
          :value="this.fields.category"
          class="form-control"
          @change="onChangeProperty($event, 'category')"
        >
          <option
            v-for="category in categories"
            :value="category.name"
            :key="'F' + category.id"
          >{{ category.name }}</option>
        </select>
        <span>
          Rok:
          <select
            :value="this.fields.year"
            class="form-control"
            @change="onChangeProperty($event, 'year')"
          >
            <option v-for="year in years" :value="year" :key="'A' + year">{{ year }}</option>
          </select>
        </span>
        <span>
          Kraj:
          <select
            :value="this.fields.country"
            class="form-control"
            @change="onChangeProperty($event, 'country')"
          >
            <option
              v-for="country in countries"
              :value="country.name"
              :key="'B' + country.id"
            >{{ country.name }}</option>
          </select>
        </span>
      </div>
    </div>
    <div class="block">
      <span>
        Aktywne filtry:
        <!-- <span v-for="(val, key) in $props" :key="key">{{ val }}</span> -->
      </span>
    </div>
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
      <!-- <b-nav class="bhead justify-content-around" pills>
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
        <p v-if="activeTab === 1 && state" class="bar mb-0 text-center">
          Aktualnie przeglądasz
          <b>ostatnio dodane</b> filmy.
        </p>
        <p v-if="activeTab === 2 && state" class="bar mb-0 text-center">
          Aktualnie przeglądasz
          <b>ostatnio oglądane</b> filmy.
        </p>
        <p v-if="activeTab === 3 && state" class="bar mb-0 text-center">
          Aktualnie przeglądasz
          <b>najpopularniejsze</b> filmy.
        </p>
        <div class="text-center mt-2" v-if="!state">
          <div v-for="movie in movies.data" :key="'C' + movie.id">
            <ContentLoader :height="80" :speed="1" primaryColor="#af9673" :animate="true">
              <rect x="0" y="0" width="50" height="70" />
              <rect x="60" y="0" rx="3" ry="3" width="150" height="10" />
              <rect x="60" y="20" rx="3" ry="3" width="250" height="10" />
              <rect x="60" y="40" rx="3" ry="3" width="330" height="10" />
              <rect x="60" y="60" rx="3" ry="3" width="330" height="10" />
            </ContentLoader>
          </div>
        </div>

        <div v-else v-for="movie in movies.data" :key="'D' + movie.id" class="item d-flex m-2">
          <div class="poster">
            <img :src="'/storage/poster/'+movie.id+'.jpg'" class="thumb" alt />
          </div>
          <div class="info2">
            <a :href="movie.path" title class="font-weight-bold">{{ movie.title }}</a>
            <div class="gen">
              <a :href="'/filmy?year=' + movie.release_date">{{ movie.release_date }}</a> |
              <a
                v-for="(category, index) in movie.categories"
                :key="'E' + category.id"
                :href="'/filmy?category=' + category.name"
              >
                <span v-if="index != 0">,</span>
                <span>{{ category.name }}</span>
              </a>
              |
              <a
                v-for="country in movie.countries"
                :key="'F' + country.id"
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
        <pagination
          align="right"
          :show-disabled="true"
          :data="movies"
          @pagination-change-page="getResults"
        ></pagination>
      </div>
    </div>
  </div>
</template> 

<script>
import { ContentLoader } from "vue-content-loader";

export default {
  components: {
    ContentLoader,
  },
  props: {
    category: String,
    year: String,
    country: String,
  },
  data() {
    return {
      fields: {
        sortBy: "created_at",
        category: this.category,
        year: this.year,
        country: this.country,
      },
      activeTab: 1,
      movies: {},
      state: false,
      categories: [],
      countries: [],
    };
  },
  mounted() {
    axios.all([axios.get("/api/categories"), axios.get("/api/countries")]).then(
      axios.spread((...responses) => {
        this.categories = responses[0].data.data;
        this.countries = responses[1].data.data;
      })
    );
    this.getResults();
  },
  methods: {
    changeSort(field) {
      this.state = false;
      this.fields.sortBy = field;
      this.getResults();
      this.setParams();
    },
    onChangeProperty(event, theProp) {
      this.fields[theProp] = event.target.value;
      this.getResults();
      this.setParams();
    },
    setParams(
      category = this.fields.category,
      year = this.fields.year,
      country = this.fields.country
    ) {
      const params = new URLSearchParams();
      category ? params.append("category", category) : void 0;
      year ? params.append("year", year) : void 0;
      country ? params.append("country", country) : void 0;
      history.replaceState(null, null, "/filmy?" + params.toString());
    },
    getResults(page = 1) {
      this.state = false;
      const url = "/api/movies";
      axios
        .get(url, {
          params: {
            page: page,
            sortBy: this.fields.sortBy,
            category: this.fields.category,
            year: this.fields.year,
            country: this.fields.country,
          },
        })
        .then((response) => {
          this.movies = response.data;
          this.state = true;
        });
    },
  },
  computed: {
    years() {
      const year = new Date().getFullYear();
      return Array.from(
        { length: year - 1888 },
        (value, index) => 1889 + index
      );
    },
  },
};
</script>