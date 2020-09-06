<template>
  <div>
    <h1>Przegląd filmów</h1>
    <b-table
      striped
      small
      hover
      :fields="fields"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :items="movies"
    >
      <template v-slot:cell(visiblity)>
        <font-awesome-icon :icon="['fas', 'dot-circle']" />
      </template>
      <template v-slot:cell(slider)>
        <font-awesome-icon :icon="['fas', 'dot-circle']" />
      </template>
      <template v-slot:cell(report)>
        <font-awesome-icon :icon="['fas', 'dot-circle']" />
      </template>
      <template v-slot:cell(actions)>
        <font-awesome-icon :icon="['fas', 'edit']" />
        <font-awesome-icon :icon="['fas', 'list']" />
        <font-awesome-icon :icon="['fas', 'trash-alt']" />
      </template>
    </b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fields: [
        { key: "title2", label: "", sortable: true },
        { key: "title", label: "Tytuł", sortable: true },
        {
          key: "views",
          label: "Wyświetlenia",
          sortable: true,
          class: "text-center",
        },
        { key: "links", label: "Linki", sortable: true, class: "text-center" },
        { key: "visiblity", label: "Widoczność", class: "text-center" },
        { key: "slider", label: "Slider", class: "text-center" },
        { key: "report", label: "Zgłoszenie", class: "text-center" },
        { key: "actions", label: "" },
      ],
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