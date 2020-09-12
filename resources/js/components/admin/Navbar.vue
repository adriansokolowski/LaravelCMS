<template>
  <v-navigation-drawer v-model="drawer" app >
    <v-list dense>
      <v-list-item link exact :to="{ name: 'home' }">
        <v-list-item-action>
          <v-icon>mdi-home</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Strona Główna</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-group :value="false">
        <template v-slot:activator>
          <!-- <v-list-item-action>
            <v-icon>mdi-cog</v-icon>
          </v-list-item-action> -->
          <v-list-item-content>
            <v-list-item-title>USTAWIENIA SERWISU</v-list-item-title>
          </v-list-item-content>
        </template>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-cog</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Ustawienia</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-google</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>SEO</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-bullhorn</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Reklama</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-motion-play</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Odtwarzacz</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-cash</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Premium</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-group>
      <v-list-item link exact :to="{ name: 'admin.movies.index' }">
        <v-list-item-action>
          <v-icon>mdi-filmstrip</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Filmy</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item link exact :to="{ name: 'home' }">
        <v-list-item-action>
          <v-icon>mdi-filmstrip-box-multiple</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Seriale</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item link exact :to="{ name: 'home' }">
        <v-list-item-action>
          <v-icon>mdi-account-multiple</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Użytkownicy</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item link exact :to="{ name: 'home' }">
        <v-list-item-action>
          <v-icon>mdi-comment-multiple</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Komentarze</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item link exact :to="{ name: 'home' }">
        <v-list-item-action>
          <v-icon>mdi-transfer-down</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Crawler</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item link exact :to="{ name: 'home' }">
        <v-list-item-action>
          <v-icon>mdi-progress-clock</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Oczekujące</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-group :value="false">
        <template v-slot:activator>
          <!-- <v-list-item-action>
            <v-icon>mdi-cog</v-icon>
          </v-list-item-action> -->
          <v-list-item-content>
            <v-list-item-title>POZOSTAŁE</v-list-item-title>
          </v-list-item-content>
        </template>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Wersje</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Wersje</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Jakość</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Kraje</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Kategorie</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Podstrony</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Obsługiwane serwisy</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Upload</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Wyczyść stronę</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Opróżnij cache</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link exact :to="{ name: 'home' }">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Informacje o systemie</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  data() {
    return {
      drawer: true,
    };
  },
};
</script>