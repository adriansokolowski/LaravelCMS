<template>
  <div>
    <BootstrapSidebar
      :initial-show="initialShow"
      :links="links"
      :header="header"
      :fa="true"
      @sidebarChanged="onSidebarChanged"
    >
      <template v-slot:navbar>
        <b-navbar id="mainNavbar" toggleable="lg" type="light" variant="light" fixed="top">
          <b-navbar-nav>
            <b-nav-item>Panel administratora</b-nav-item>
          </b-navbar-nav>
        </b-navbar>
      </template>

      <template v-slot:content>
        <b-container style="margin-top: 56px">
          <router-view />
        </b-container>
      </template>
    </BootstrapSidebar>
  </div>
</template>

<script>
import BootstrapSidebar from "vue-bootstrap-sidebar";

export default {
  data() {
    return {
      initialShow: true,
      header: "<h3>Panel</h3>",
      links: [
        { name: "Statystyki", href: { name: "home" }, faIcon: ["fas", "home"] },
        {
          name: "Ustawienia_serwisu",
          faIcon: ["fas", "tint"],
          children: [
            {
              name: "Ustawienia",
              href: {
                name: "child-item-1",
              },
              faIcon: ["fas", "edit"],
            },
            {
              name: "SEO",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Reklama",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Odtwarzacz",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Premium",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
          ],
        },
        {
          name: "Filmy",
          href: { name: "admin.movies.index" },
          faIcon: "users",
        },
        {
          name: "Seriale",
          href: { name: "admin.movies.index" },
          faIcon: "phone",
        },
        {
          name: "Użytkownicy",
          href: { name: "admin.movies.index" },
          faIcon: "phone",
        },
        {
          name: "Komentarze",
          href: { name: "admin.movies.index" },
          faIcon: "phone",
        },
        {
          name: "Crawler",
          href: { name: "admin.movies.index" },
          faIcon: "phone",
        },
        {
          name: "Oczekujące",
          href: { name: "admin.movies.index" },
          faIcon: "phone",
        },
        {
          name: "Pozostałe",
          faIcon: ["fas", "tint"],
          children: [
            {
              name: "Wersje",
              href: {
                name: "child-item-1",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Jakość",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Kraje",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Kategorie",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Podstrony",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Obsługiwane serwisy",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Upload",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Wyczyść stronę",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Opróżnij cache",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Wyczyść shoutbox",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
            {
              name: "Informacje o systemie",
              href: {
                name: "child-item-2",
              },
              faIcon: ["fas", "child"],
            },
          ],
        },
      ],
    };
  },
  methods: {
    onSidebarChanged() {},
  },
};
</script>

<style lang="scss" scope>
@import '~bootstrap/scss/bootstrap';
@import '~bootstrap-vue/src/index.scss';
@import "node_modules/vue-bootstrap-sidebar/src/scss/default-theme";
</style> 