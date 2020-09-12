<template>
  <div>
    <h3 class="text-uppercase light-blue--text text--darken-2">Przegląd użytkowników</h3>
    <v-data-table
      dense
      :headers="headers"
      :items="users"
      :search="search"
      :items-per-page="10"
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
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Szukaj"
            single-line
            hide-details
          ></v-text-field>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="red" dark class="mb-2" v-bind="attrs" v-on="on">Usuń zaznaczone</v-btn>
            </template>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.slider="{ item }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon color="red" dark v-bind="attrs" v-on="on">mdi-radiobox-marked</v-icon>
          </template>
          <span>Aktywuj</span>
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
            <v-icon
              color="red"
              @click="deleteUser(item)"
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
const headers = [
  { text: "Nazwa użytkownika", value: "name" },
  { text: "Adres IP", align: "center", value: "" },
  { text: "Adres e-mail", value: "email" },
  {
    text: "Data rejestracji",
    value: "email_verified_at",
    sortable: false,
  },
  { text: "Aktywowane", align: "center", value: "slider", sortable: false },
  { text: "", value: "actions", sortable: false },
];

export default {
  data() {
    return {
      search: "",
      isLoading: true,
      selected: [],
      users: [],
    };
  },
  mounted() {
    this.getResults();
  },
  methods: {
    getResults() {
      this.isLoading = true;
      axios.get("/api/admin/users/").then((response) => {
        this.users = response.data.data;
        this.isLoading = false;
      });
    },
    deleteUser(user) {
      this.$swal({
        title: "Potwierdź",
        text:
          "Czy na pewno chcesz usunąć użytkownika " +
          user.name +
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
            .delete("/api/admin/users/" + user.id)
            .then((response) => {
              this.$swal({
                icon: "success",
                title: "Użytkownik został usunięty",
              });
              this.getResults();
            })
            .catch((error) => {
              this.$swal({ icon: "error", title: "Wystąpił błąd" });
            });
        }
      });
    },
  },
  computed: {
    headers() {
      return headers;
    },
  },
};
</script> 