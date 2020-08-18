<template>
  <div class="block mb-1">
    <div class="bhead text-center">Filmy Online</div>
    <div class="bbody categories">
        <div v-for="category in categories" :key="category.id" class="category">
            <a href="">{{ category.name }}</a>
            <!-- <a href="{{ route('movies.index', ['gatunek' => $category->name]) }}">
                {{ $category->name }} ({{ $category->movies->count() }})
            </a> -->
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: null
    };
  },
  mounted() {
    axios.get("/api/categories").then((response) => {
      this.categories = response.data.data;
    });
  },
};
</script>