<style scoped>
#table {
  display: table;
  width: 100%;
}
.tr {
  display: table-row;
}
.td {
  display: table-cell;
  padding: 1rem;
}

.row1 {
  width: 25%;
  background-color: #f0e3cf;
}
.row2 {
  background-color: #f7efe3;
}
</style>


<template>
  <form @submit.prevent="submit">
    <div class="alert alert-success text-center" v-show="success" role="alert">
      Film został dodany.
      <a :href="movie">Przejdź</a>
    </div>
    <div id="table">
      <div class="tr">
        <div class="td row1">
          <label for="title" class="col-md-3 col-form-label text-md-right font-weight-bold">Tytuł</label>
        </div>
        <div class="td row2">
          <div class="input-group">
            <input
              id="title"
              type="text"
              v-model="fields.title"
              :class="{ 'is-invalid' : (errors && errors.title) || (error)}"
              class="form-control"
              required
              autocomplete="title"
              autofocus
            />
            <div class="input-group-append">
              <button-spinner :is-loading="a" :disabled="a" :status="c">
                <span v-on:click="importData">Importuj</span>
              </button-spinner>
            </div>
            <span class="invalid-feedback" v-if="errors && errors.title" role="alert">
              <strong>{{ errors.title[0] }}</strong>
            </span>
            <span class="invalid-feedback" v-if="error" role="alert">
              <strong>Wystąpił problem podczas importowania '{{ this.fields.title }}'</strong>
            </span>
          </div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label
            for="release_date"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Premiera</label>
        </div>
        <div class="td row2">
          <input
            id="release_date"
            type="date"
            v-model="fields.release_date"
            class="form-control"
            required
            autocomplete="release_date"
            autofocus
          />
          <div
            class="alert alert-danger"
            v-if="errors && errors.release_date"
          >{{ errors.release_date[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label
            for="release_date"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Plakat</label>
        </div>
        <div class="td row2">
          <input
            id="poster"
            type="text"
            v-model="fields.poster"
            class="form-control"
            required
            autocomplete="poster"
            autofocus
          />
          <div class="alert alert-danger" v-if="errors && errors.poster">{{ errors.poster[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label
            for="categories"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Kategoria</label>
        </div>
        <div class="td row2">
          <multi-select
            track-by="id"
            label="name"
            v-model="fields.categories"
            :options="categories"
            :multiple="true"
          ></multi-select>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label
            for="description"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Opis</label>
        </div>
        <div class="td row2">
          <textarea
            class="form-control"
            v-model="fields.description"
            placeholder="Opis filmu..."
            rows="6"
          ></textarea>
          <div class="alert alert-danger" v-if="errors && errors.poster">{{ errors.description[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label
            for="imdb_rate"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Ocena</label>
        </div>
        <div class="td row2">
          <input
            id="imdb_rate"
            type="text"
            v-model="fields.imdb_rate"
            class="form-control"
            autocomplete="imdb_rate"
            autofocus
          />
          <div
            class="alert alert-danger"
            v-if="errors && errors.imdb_rate"
          >{{ errors.imdb_rate[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label for="slider" class="col-md-3 col-form-label text-md-right font-weight-bold">Zdjęcie</label>
        </div>
        <div class="td row2">
          <input
            id="slider"
            type="number"
            v-model="fields.slider"
            class="form-control"
            autocomplete="slider"
            autofocus
          />
          <div class="alert alert-danger" v-if="errors && errors.slider">{{ errors.slider[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label
            for="trailer"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Zwiastun</label>
        </div>
        <div class="td row2">
          <input
            id="trailer"
            type="number"
            v-model="fields.trailer"
            class="form-control"
            autocomplete="trailer"
            autofocus
          />
          <div class="alert alert-danger" v-if="errors && errors.trailer">{{ errors.trailer[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label for="fdb" class="col-md-3 col-form-label text-md-right font-weight-bold">Fdb.pl</label>
        </div>
        <div class="td row2">
          <input
            id="fdb"
            type="number"
            v-model="fields.fdb"
            class="form-control"
            required
            autocomplete="fdb"
            autofocus
          />
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label
            for="trailer"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Reżyseria</label>
        </div>
        <div class="td row2">
          <input-tag v-model="fields.direction"></input-tag>
          <div class="alert alert-danger" v-if="errors && errors.trailer">{{ errors.trailer[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label
            for="trailer"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Scenariusz</label>
        </div>
        <div class="td row2">
          <input-tag v-model="fields.screenplay"></input-tag>
          <div class="alert alert-danger" v-if="errors && errors.trailer">{{ errors.trailer[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Kraj</label>
        </div>
        <div class="td row2">
          <input-tag v-model="fields.countries"></input-tag>
          <div class="alert alert-danger" v-if="errors && errors.trailer">{{ errors.trailer[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Obsada</label>
        </div>
        <div class="td row2">
          <input-tag v-model="fields.cast"></input-tag>
          <div class="alert alert-danger" v-if="errors && errors.trailer">{{ errors.trailer[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Tag</label>
        </div>
        <div class="td row2">
          <input-tag v-model="fields.tags"></input-tag>
          <div class="alert alert-danger" v-if="errors && errors.trailer">{{ errors.trailer[0] }}</div>
        </div>
      </div>
    </div>
    <div style="padding: 1rem; background-color: #b39a76;" class="d-flex justify-content-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="submit" v-on:click="clearAll" class="btn btn-custom2">Wyczyść</button>
            <button type="submit" class="btn btn-custom2">Zapisz</button>
        </div>
    </div>
  </form>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      a: false,
      c: "",
      movie: null,
      categories: [],
      fields: {
        title: '',
        user_id: '',
        release_date: '',
        poster: '',
        categories: [],
        description: '',
        imdb_rate: '',
        slider: '',
        trailer: '',
        fdb: '',
        direction: [],
        screenplay: [],
        countries: [],
        cast: [],
        tags: [],
      },
      success: false,
      error: false,
      errors: {},
    };
  },
  mounted() {
    axios.get("/api/categories").then((response) => {
      this.categories = response.data.data;
    });
  },
  methods: {
    submit() {
      const data = {
        ...this.fields,
        user_id: this.user.id,
        categories: this.fields.categories.map((x) => x.id),
      };
      axios
        .post("/api/movies", data)
        .then((response) => {
          this.movie = response.data;
          this.success = true;
          this.fields = { categories: [] };
          this.errors = {};
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    clearAll(e){
      e.preventDefault();
      this.fields = {};
      this.errors = {};
      this.error = false;
    },
    importData(e) {
      e.preventDefault();
      this.a = true;
      this.errors = {};
      axios
        .post("/import", {
          title: this.fields.title,
        })
        .then((response) => {
          this.a = false;
          this.error = false;
          this.fields = response.data;
          this.fields.categories = this.categories.filter((x) =>
          this.fields.categories.includes(x.name)
          );
        })
        .catch((error) => {
          this.error = true;
          this.a = false;
        });
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>