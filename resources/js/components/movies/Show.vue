<template>
  <div>
    <div class="block">
      <b-nav class="bhead justify-content-center" pills>
        <b-nav-item
          :active="activeTab === 1"
          @click.prevent="changeTab('created_at'), activeTab = 1"
        >Opis filmu</b-nav-item>
        <b-nav-item
          :active="activeTab === 2"
          @click.prevent="changeTab('last_view'), activeTab = 2"
        >Oglądaj online</b-nav-item>
      </b-nav>
      <div class="bbody">
        <div class="about_movie_title">{{ movie.title }} ({{ movie.release_date }})</div>
        <div class="about_movie">
          <div class="poster">
            <img :src="'/storage/poster/'+movie.id+'.jpg'" class="thumb" alt />
          </div>
        </div>
      </div>
    </div>
    <div v-if="activeTab === 1" class="block">
      <div class="bhead text-center">Opis filmu</div>
      <div class="bbody">{{ movie.description }}</div>
    </div>
    <div v-if="activeTab === 2" class="block">
      <div class="bhead text-center">Linki</div>
      <div class="bbody">
        <table v-if="Object.keys(movie.links).length !== 0" class="table">
          <thead>
            <tr>
              <th scope="col">Hosting</th>
              <th scope="col">Wersja</th>
              <th scope="col">Jakość</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="link in movie.links" :key="link.id">
              <td>{{ link.domain }}</td>
              <td>{{ link.version }}</td>
              <td>{{ link.quality }}</td>
            </tr>
          </tbody>
        </table>
        <b-alert
          v-else
          show
          variant="info"
        >Wygląda na to, że ten materiał nie posiada żadnych linków :(</b-alert>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["movieid"],
  data() {
    return {
      activeTab: 1,
      movie: {},
    };
  },
  methods: {
    changeTab(field) {},
  },
  mounted() {
    axios.get("/api/movies/" + this.movieid).then((response) => {
      this.movie = response.data.data;
      console.log(this.movie.links);
    });
  },
};
</script>

