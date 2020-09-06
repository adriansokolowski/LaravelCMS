<template>
  <b-container fluid>
    <h1>Przegląd filmów</h1>
    <b-col lg="4" class="my-1">
      <b-input-group size="sm">
        <b-form-input
          v-model="filter"
          type="search"
          id="filterInput"
          placeholder="Przeszukaj tę tabelę"
        ></b-form-input>
        <b-input-group-append>
          <b-button :disabled="!filter" @click="filter = ''">Wyczyść</b-button>
        </b-input-group-append>
      </b-input-group>
    </b-col>
    <b-table
      striped
      bordered
      small
      hover
      :fields="fields"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :items="movies"
      :per-page="perPage"
      :filter="filter"
      @filtered="onFiltered"
      :busy="isBusy"
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
      <template v-slot:cell(actions)="data">
        <font-awesome-icon :icon="['fas', 'edit']" />
        <font-awesome-icon :icon="['fas', 'list']" />
        <font-awesome-icon
          :class="pointer"
          @click="deleteMovie(data.item)"
          :icon="['fas', 'trash-alt']"
        />
      </template>
      <template v-slot:table-busy>
        <div class="text-center my-2">
          <b-spinner class="align-middle" label="Spinning"></b-spinner>
          <strong>Wczytywanie...</strong>
        </div>
      </template>
    </b-table>
  </b-container>
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
        { key: "actions", label: "", class: "text-center" },
      ],
      filter: null,
      filterOn: [],
      movies: null,
      isBusy: true
    };
  },
  mounted() {
    this.getResults();
  },
  methods: {
    getResults() {
      this.isBusy = true;
      axios.get("/api/adminmovies").then((response) => {
        this.movies = response.data.data;
        this.isBusy = false;
      });
    },
    deleteMovie(movie) {
      this.$swal({
        title: "Potwierdź",
        text:
          "Czy na pewno chcesz usunąć film " +
          movie.title +
          "? Zmian nie można cofnąć.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "OK",
        cancelButtonText: "Anuluj",
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/adminmovies/" + movie.id)
            .then((response) => {
              this.$swal({ icon: "success", title: "Film został usunięty" });
              this.getResults();
            })
            .catch((error) => {
              this.$swal({ icon: "error", title: "Wystąpił błąd" });
            });
        }
      });
    },
  },
};
</script> 