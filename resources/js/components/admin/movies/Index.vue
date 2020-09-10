<template>
  <div>
    <v-text-field
      v-model="search"
      append-icon="mdi-magnify"
      label="Szukaj"
      single-line
      hide-details
    ></v-text-field>
    <v-data-table
      dense
      :headers="headers"
      :items="movies"
      :search="search"
      :items-per-page="5"
      show-select
      class="elevation-1"
      :loading="isLoading"
      loading-text="Wczytywanie..."
      :footer-props="{
           'items-per-page-text':'liczba wierszy'
      }"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>Przegląd filmów</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="red" dark class="mb-2" v-bind="attrs" v-on="on">Usuń zaznaczone</v-btn>
            </template>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.visiblity="{ item }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon color="green" dark v-bind="attrs" v-on="on">mdi-radiobox-marked</v-icon>
          </template>
          <span>Ukryj</span>
        </v-tooltip>
      </template>
      <template v-slot:item.slider="{ item }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon color="green" dark v-bind="attrs" v-on="on">mdi-radiobox-marked</v-icon>
          </template>
          <span>Ukryj</span>
        </v-tooltip>
      </template>
      <template v-slot:item.report="{ item }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon color="green" dark v-bind="attrs" v-on="on">mdi-radiobox-marked</v-icon>
          </template>
          <span>Ukryj</span>
        </v-tooltip>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon color="blue" dark v-bind="attrs" v-on="on">mdi-clipboard-edit</v-icon>
          </template>
          <span>Edytuj</span>
        </v-tooltip>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon color="green" dark v-bind="attrs" v-on="on">mdi-format-list-bulleted</v-icon>
          </template>
          <span>Edycja linków</span>
        </v-tooltip>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              color="red"
              @click="deleteMovie(item)"
              dark
              v-bind="attrs"
              v-on="on"
            >mdi-trash-can</v-icon>
          </template>
          <span>Usuń</span>
        </v-tooltip>
      </template>
      <template slot="no-data">Brak danych do wyświetlenia</template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      isLoading: true,
      selected: [],
      movies: [],
      headers: [
        { text: "Tytuł", value: "title" },
        { text: "Wyświetlenia", align: "center", value: "views" },
        { text: "Linki", align: "center", value: "views" },
        { text: "Widoczność", align: "center", value: "visiblity" },
        { text: "Slider", align: "center", value: "slider" },
        { text: "Zgłoszenie", align: "center", value: "report" },
        { text: "", value: "actions", sortable: false },
      ],
    };
  },
  mounted() {
    this.getResults();
  },
  methods: {
    getResults() {
      this.isLoading = true;
      axios.get("/api/adminmovies").then((response) => {
        this.movies = response.data.data;
        this.isLoading = false;
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