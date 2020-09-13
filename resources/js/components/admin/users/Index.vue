<template>
  <div>
    <v-row>
      <v-col>
        <v-card color="#00b297" dark max-width="344" :loading="isLoading">
          <v-list-item three-line>
            <v-icon left size="100">mdi-account-group</v-icon>
            <v-list-item-content>
              <v-card-title class="p-0 subtitle-2">Wszyscy użytkownicy</v-card-title>
              <v-list-item-title class="headline mb-1">{{ additional.total }}</v-list-item-title>
              <v-list-item-subtitle>3.41%</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-card>
      </v-col>
      <v-col>
        <v-card color="blue" dark max-width="344" :loading="isLoading">
          <v-list-item three-line>
            <v-icon left size="100">mdi-account-question</v-icon>
            <v-list-item-content>
              <v-card-title class="p-0 subtitle-2">Nowi użytkownicy</v-card-title>
              <v-list-item-title class="headline mb-1">{{ additional.total }}</v-list-item-title>
              <v-list-item-subtitle>3.41% więcej niż wczoraj</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-card>
      </v-col>
      <v-col>
        <v-card color="red" dark max-width="344" :loading="isLoading">
          <v-list-item three-line>
            <v-icon left size="100">mdi-account-hard-hat</v-icon>
            <v-list-item-content>
              <v-card-title class="p-0 subtitle-2">Aktywni użytkownicy</v-card-title>
              <v-list-item-title class="headline mb-1">{{ additional.total }}</v-list-item-title>
              <v-list-item-subtitle>3.41%</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-card>
      </v-col>
    </v-row>
    <v-toolbar flat color="white">
      <h3 class="text-uppercase light-blue--text text--darken-2">Przegląd użytkowników</h3>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="blue" dark class="mb-2" v-bind="attrs" v-on="on">
            <v-icon left>mdi-account-plus</v-icon>Dodaj użytkownika
          </v-btn>
        </template>
      </v-dialog>
    </v-toolbar>
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
            prepend-inner-icon="mdi-magnify"
            label="Szukaj"
            single-line
            hide-details
          ></v-text-field>
          <v-spacer></v-spacer>

          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn depressed color="red" dark class="mb-2" v-bind="attrs" v-on="on">
                <v-icon left>mdi-delete</v-icon>Usuń zaznaczone
              </v-btn>
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
    value: "created_at",
    sortable: true,
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
      additional: [],
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
        console.log(response.data.data);
        this.additional = response.data.users;
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