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

