<template>
  <div>
    <div class="block">
      <b-nav class="bhead justify-content-center" pills>
        <b-nav-item
          :active="activeTab === 1"
          @click.prevent="changeTab('created_at'), activeTab = 1"
        >Opis filmu</b-nav-item>
        <b-nav-item
          :active="activeTab === 2"
          @click.prevent="changeTab('last_view'), activeTab = 2"
        >Oglądaj online</b-nav-item>
      </b-nav>
      <div class="bbody">
        <div class="about_movie_title">{{ movie.title }} ({{ movie.release_date }})</div>
        <div class="about_movie">
          <div class="poster">
            <img :src="'/storage/poster/'+movie.id+'.jpg'" class="thumb" alt />
          </div>
          <div>
            <table class="table">
              <tbody>
                <tr>
                  <th>Gatunek:</th>
                  <td>
                    <a
                      v-for="(category, index) in movie.categories"
                      :key="category.id"
                      :href="'/filmy?category=' + category.name"
                    >
                      <span v-if="index != 0">,</span>
                      <span>{{ category.name }}</span>
                    </a>
                  </td>
                </tr>
                <tr>
                  <th>Wyświetleń:</th>
                  <td>{{ movie.views }}</td>
                  <th>Kraj produkcji:</th>
                  <td>
                    <a
                      v-for="(country, index) in movie.countries"
                      :key="country.id"
                      :href="'/filmy?country=' + country.name"
                    >
                      <span v-if="index != 0">,</span>
                      <span>{{ country.name }}</span>
                    </a>
                  </td>
                </tr>
                <tr>
                  <th>Wersja:</th>
                  <td>asdasd</td>
                  <th>Wersja:</th>
                  <td>asdasd</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div v-if="activeTab === 1" class="block">
      <div class="bhead text-center">Opis filmu</div>
      <div class="bbody">{{ movie.description }}</div>
    </div>
    <div v-if="activeTab === 2" class="block">
      <div class="bhead text-center">Oglądaj film online</div>
      <div class="bbody">
        <div style="position:relative;padding-bottom:56%;padding-top:20px;height:0;">
          <IFRAME
            src="https://clipwatching.com/embed-3dpgzwuk88e1.html"
            frameborder="0"
            marginwidth="0"
            marginheight="0"
            scrolling="NO"
            width="640"
            height="360"
            allowfullscreen
            style="position:absolute;top:0;left:0;width:100%;height:100%;"
          ></IFRAME>
        </div>

        <table v-if="Object.keys(movie.links).length !== 0" class="table">
          <thead>
            <tr>
              <th>Hosting</th>
              <!-- <th>Wersja</th> -->
              <th>Jakość</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="link in movie.links" :key="link.id">
              <td>{{ link.domain }}</td>
              <!-- <td>{{ link.version }}</td> -->
              <td>{{ link.quality }}</td>
              <td>
                <i class="fa fa-thumbs-up" aria-hidden="true"></i> 222
                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
              </td>
            </tr>
          </tbody>
        </table>
        <b-alert
          v-else
          show
          variant="info"
        >Wygląda na to, że ten materiał nie posiada żadnych linków :(</b-alert>
      </div>
    </div>
    <div v-if="activeTab === 1" class="block">
      <div class="bhead text-center">Obsada</div>
      <div class="bbody">
        <div v-for="person in filteredStories" :key="person">{{ person.type }}</div>
        <h3>Reżyseria</h3>
        <div v-for="person in movie.persons" :key="person.id">
          <span v-if="person.pivot.type === 1">{{ person.name }}</span>
        </div>
        <h3>Scenariusz</h3>
        <div v-for="person in movie.persons" :key="person.id">
          <span v-if="person.pivot.type === 2">{{ person.name }}</span>
        </div>
        <h3>Aktorzy</h3>
        <div v-for="person in movie.persons" :key="person.id">
          <span v-if="person.pivot.type === 3">{{ person.name }}</span>
        </div>
      </div>
    </div>
    <div class="block">
      <div class="bhead text-center">Opinie widzów</div>
      <div class="bbody">
        <v-container fluid>
          <v-textarea counter label="Treść komentarza..." :rules="rules" :value="value"></v-textarea>
          <v-btn small dark color="primary">Dodaj komentarz</v-btn>
        </v-container>

        <v-list three-line>
          <template v-for="(item, index) in movie.comments">
            <v-subheader v-if="item.header" :key="item.header" v-text="item.header"></v-subheader>

            <v-divider v-else-if="item.divider" :key="index" :inset="item.inset"></v-divider>

            <v-list-item v-else :key="item.comment" @click>
              <v-list-item-avatar>
                <v-img :src="item.avatar"></v-img>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title v-html="item.comment"></v-list-item-title>
                <v-list-item-subtitle v-html="item.comment"></v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </template>
        </v-list>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["movieid"],
  data() {
    return {
      activeTab: 1,
      movie: {},
    };
  },
  methods: {
    changeTab(field) {},
  },
  mounted() {
    axios.get("/api/movies/" + this.movieid).then((response) => {
      this.movie = response.data.data;
    });
  },
  computed: {
    filteredStories() {
      //console.log(this.movie.filter((i) => i.persons.pivot.type == 1));
      //return this.movie.filter((i) => i.persons.pivot.type == 1);
    },
    filteredStories2() {
      //return this.movie.filter((i) => i.persons.type === 1);
    },
  },
};
</script>

