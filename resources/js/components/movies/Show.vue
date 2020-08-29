<template>
  <div class="block">
    <div class="bhead">asd</div>
    <div class="bbody">
      <div class="about_movie_title">{{ movie.title }} ({{ movie.release_date }})</div>
    </div>
  </div>
</template>

<script>
    export default {
        props: ["movieid"],
        data() {
            return {
                movie: {}
            }
        },
        mounted() {
            axios.get('/api/movies/' + this.movieid).then((response) => {
                this.movie = response.data;
            })
        }
    }
</script>

