<template>
  <div>
      <!-- <div class="block mb-1">
      <div class="bhead text-center">
        {{ this.user.name }} Konto Ulubione
        <a href="/wyloguj">Wyloguj</a>

        <a href="/admin">Panel administratora</a>
      </div>
      <div class="bbody">-->
      <div class="text-center">
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark v-bind="attrs" v-on="on">Dropdown</v-btn>
          </template>
          <v-list>
            <v-list-item v-for="(item, index) in items" :key="index" @click>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </div>
      <v-row>
          <v-col class="my-0 py-0" align="left">
            <v-list-item three-line>
              <v-list-item-content>
                <v-list-item-subtitle>Typ konta: VIP</v-list-item-subtitle>
                <v-list-item-subtitle>Obejrzane filmy: 1000</v-list-item-subtitle>
                <v-list-item-subtitle>Dodane filmy: 2</v-list-item-subtitle>
                <v-list-item-subtitle>Zebrane punkty: 2018</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-col>
          <v-col class="my-0 py-0" align="right">
            <v-avatar tile size="100">
              <img src="/storage/user/default.png" alt="John" />
            </v-avatar>
          </v-col>
        </v-row>
      </div>
      </div>
  </div>
</template>

<script>
import Vuetify from "vuetify";

export default {
  props: {
    user: Object,
  },
  data() {
    return {
      items: [
        { title: "Click Me" },
        { title: "Click Me" },
        { title: "Click Me" },
        { title: "Click Me 2" },
      ],
    };
  },
  mounted() {
    console.log(this.user);
  },
};
</script>