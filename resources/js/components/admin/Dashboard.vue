<template>
  <div>
    <section class="container">
      <router-link
        active-class="active-menu"
        exact
        :to="{ name: 'admin.movies.index' }"
        class="nav-link"
      >Filmy</router-link>
    </section>
    <main class="py-4">
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
export default {};
</script>