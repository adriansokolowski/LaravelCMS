<template>
  <div>
    <div class="block">
      <div class="bhead text-center">Filtry</div>
      <div class="bbody">
        <span>Gatunek:</span>
        <select :value="this.fields.category" @change="onChangeCategory">
          <option
            v-for="category in categories"
            :value="category.name"
            :key="category.id"
          >{{ category.name }}</option>
        </select>
        <span>
          Rok:
          <select :value="this.fields.year" @change="onChangeYear">
            <option v-for="year in years" :value="year" :key="year">{{ year }}</option>
          </select>
        </span>
        <span>
          Kraj:
          <select :value="this.fields.country" @change="onChangeCountry">
            <option
              v-for="country in countries"
              :value="country.name"
              :key="country.id"
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
      <b-nav class="bhead justify-content-around" pills>
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
      </b-nav>
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

        <ContentLoader v-if="!state" :height="80" :speed="1" primaryColor="#af9673" :animate="true">
          <rect x="0" y="0" width="50" height="70" />
          <rect x="60" y="0" rx="3" ry="3" width="150" height="10" />
          <rect x="60" y="20" rx="3" ry="3" width="250" height="10" />
          <rect x="60" y="40" rx="3" ry="3" width="300" height="10" />
          <rect x="60" y="60" rx="3" ry="3" width="300" height="10" />
        </ContentLoader>
        <ContentLoader v-if="!state" :height="80" :speed="1" primaryColor="#af9673" :animate="true">
          <rect x="0" y="0" width="50" height="70" />
          <rect x="60" y="0" rx="3" ry="3" width="150" height="10" />
          <rect x="60" y="20" rx="3" ry="3" width="300" height="10" />
          <rect x="60" y="40" rx="3" ry="3" width="300" height="10" />
          <rect x="60" y="60" rx="3" ry="3" width="300" height="10" />
        </ContentLoader>
        <ContentLoader v-if="!state" :height="80" :speed="1" primaryColor="#af9673" :animate="true">
          <rect x="0" y="0" width="50" height="70" />
          <rect x="60" y="0" rx="3" ry="3" width="150" height="10" />
          <rect x="60" y="20" rx="3" ry="3" width="300" height="10" />
          <rect x="60" y="40" rx="3" ry="3" width="300" height="10" />
          <rect x="60" y="60" rx="3" ry="3" width="300" height="10" />
        </ContentLoader>

        <div v-else v-for="movie in movies.data" :key="movie.id" class="item d-flex m-2">
          <div class="poster">
            <img :src="'/storage/poster/'+movie.id+'.jpg'" class="thumb" alt />
          </div>
          <div class="info">
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
                <i class="fa fa-microphone" aria-hidden="true"></i>
                <i class="fa fa-globe" aria-hidden="true"></i>
                <i class="fa fa-align-left" aria-hidden="true"></i>
              </span>
            </p>
          </div>
        </div>
        <pagination :data="movies" @pagination-change-page="getResults"></pagination>
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
      state: true,
      categories: {},
      countryies: {},
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
    onChangeCategory(event) {
      this.fields.category = event.target.value;
      this.getResults();
      this.setParams();
    },
    onChangeYear(event) {
      this.fields.year = event.target.value;
      this.getResults();
      this.setParams();
    },
    onChangeCountry(event) {
      this.fields.country = event.target.value;
      this.getResults();
      this.setParams();
    },
    setParams(
      category = this.fields.category,
      year = this.fields.year,
      country = this.fields.country
    ) {
      const params = new URLSearchParams();
      if (category) {
        params.append("category", category);
      }
      if (year) {
        params.append("year", year);
      }
      if (country) {
        params.append("country", country);
      }
      history.replaceState(null, null, "/filmy?" + params.toString());
    },
    getResults(page = 1) {
      this.state = false;
      const url = "/api/movies";
      axios
        .get(url, {
          params: {
            page: this.page,
            sortBy: this.fields.sortBy,
            category: this.fields.category,
            year: this.fields.year,
            country: this.fields.country,
          },
        })
        .then((response) => {
          this.movies = response.data;
          console.log(response.data);
          this.state = true;
        });
    },
  },
  computed: {
    years() {
      const year = new Date().getFullYear();
      return Array.from(
        { length: year - 1888 },
        (value, index) => 1901 + index
      );
    },
  },
};
</script>