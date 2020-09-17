<template>
  <div>
    <div class="block mb-1">
      <div class="bhead text-center">
        <v-row justify="space-around">
          <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn class="text-capitalize" height="24" text dark v-bind="attrs" v-on="on">
                Dodaj
                <v-icon right dark>mdi-chevron-down</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item v-for="(item, index) in add" :key="index" :href="item.link" @click>
                <v-list-item-icon>
                  <v-icon>mdi-plus</v-icon>
                </v-list-item-icon>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
          <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
              <v-icon dark v-bind="attrs" v-on="on">mdi-bell</v-icon>
            </template>
            <span>Powiadomienia</span>
          </v-tooltip>
          <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
              <v-icon dark v-bind="attrs" v-on="on">mdi-email</v-icon>
            </template>
            <span>Wiadomości</span>
          </v-tooltip>
          <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn class="text-capitalize" height="24" text dark v-bind="attrs" v-on="on">
                {{ user.name }}
                <v-icon right dark>mdi-chevron-down</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item v-for="(item, index) in settings" :key="index" :href="item.link" @click>
                <v-list-item-icon>
                  <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-row>
      </div>
      <div class="bbody">
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
            <v-avatar tile size="90">
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
      settings: [
        { title: "Profil", link: "/profil", icon: "mdi-account" },
        { title: "Ulubione", link: "/ulubione", icon: "mdi-star" },
        { title: "Do obejrzenia", link: "/do-obejrzenia", icon: "mdi-clock" },
        { title: "Premium", link: "/premium", icon: "mdi-star" },
        { title: "Ustawienia konta", link: "/ustawienia", icon: "mdi-cog" },
        { title: "Panel administratora", link: "/admin", icon: "mdi-hexagram" },
        { title: "Wyloguj", link: "/wyloguj", icon: "mdi-logout" },
      ],
      add: [
        { title: "Dodaj film", link: "/dodaj-film" },
        { title: "Dodaj serial", link: "/dodaj-serial" },
        { title: "Dodaj odcinek", link: "/dodaj-odcinek" },
      ],
    };
  },
  mounted() {
    console.log(this.user);
  },
};
</script>