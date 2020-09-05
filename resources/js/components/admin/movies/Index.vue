<template>
  <div>
    <b-table striped hover :items="movies"></b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movies: null,
    };
  },
  mounted() {
    axios.get("/api/adminmovies").then((response) => {
      this.movies = response.data.data;
    });
  },
};
</script>