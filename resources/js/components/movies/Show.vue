<template>
  <div class="block">
    <div class="bhead">Opis filmu Oglądaj online</div>
    <div class="bbody">
      <div class="about_movie_title">{{ movie.title }} ({{ movie.release_date }})</div>
      <div class="about_movie">
        <div class="poster">
          <img :src="'/storage/poster/'+movie.id+'.jpg'" class="thumb" alt />
        </div>
      </div>
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
</template>

<script>
export default {
  props: ["movieid"],
  data() {
    return {
      movie: {},
    };
  },
  mounted() {
    axios.get("/api/movies/" + this.movieid).then((response) => {
      this.movie = response.data.data;
      console.log(this.movie.links);
    });
  },
};
</script>

