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
              <button-spinner
                :is-loading="isBtnLoading"
                :disabled="isBtnDisabled"
                :status="btnStatus"
              >
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
          <b-form-group>
            <b-form-tags
              v-model="fields.categories"
              size="lg"
              add-on-change
              no-outer-focus
              class="mb-2"
            >
              <template v-slot="{ tags, inputAttrs, inputHandlers, disabled, removeTag }">
                <ul v-if="tags.length > 0" class="list-inline d-inline-block mb-2">
                  <li v-for="tag in tags" :key="tag" class="list-inline-item">
                    <b-form-tag
                      @remove="removeTag(tag)"
                      :title="tag"
                      :disabled="disabled"
                      variant="info"
                    >{{ tag }}</b-form-tag>
                  </li>
                </ul>
                <b-form-select
                  v-bind="inputAttrs"
                  v-on="inputHandlers"
                  :disabled="disabled || availableCategories.length === 0"
                  :options="availableCategories"
                >
                  <template v-slot:first>
                    <!-- Safari bug fix -->
                    <option disabled value>Wybierz kategorię...</option>
                  </template>
                </b-form-select>
              </template>
            </b-form-tags>
          </b-form-group>
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
            for="direction"
            class="col-md-3 col-form-label text-md-right font-weight-bold"
          >Reżyseria</label>
        </div>
        <div class="td row2">
          <b-form-tags
            input-id="tags-basic"
            v-model="fields.direction"
            placeholder
            addButtonText="dodaj"
            class="mb-2"
          ></b-form-tags>
          <div
            class="alert alert-danger"
            v-if="errors && errors.direction"
          >{{ errors.direction[0] }}</div>
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
          <b-form-tags
            input-id="tags-basic"
            v-model="fields.screenplay"
            placeholder
            addButtonText="dodaj"
            class="mb-2"
          ></b-form-tags>
          <div
            class="alert alert-danger"
            v-if="errors && errors.screenplay"
          >{{ errors.screenplay[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Kraj</label>
        </div>
        <div class="td row2">
          <b-form-tags
            input-id="tags-basic"
            v-model="fields.countries"
            placeholder
            addButtonText="dodaj"
            class="mb-2"
          ></b-form-tags>
          <div
            class="alert alert-danger"
            v-if="errors && errors.countries"
          >{{ errors.countries[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Obsada</label>
        </div>
        <div class="td row2">
          <b-form-tags
            input-id="tags-basic"
            v-model="fields.cast"
            placeholder
            addButtonText="dodaj"
            class="mb-2"
          ></b-form-tags>
          <div class="alert alert-danger" v-if="errors && errors.cast">{{ errors.cast[0] }}</div>
        </div>
      </div>
      <div class="tr">
        <div class="td row1">
          <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Tag</label>
        </div>
        <div class="td row2">
          <b-form-tags
            input-id="tags-basic"
            v-model="fields.tags"
            addButtonText="dodaj"
            placeholder
            class="mb-2"
          ></b-form-tags>
          <div class="alert alert-danger" v-if="errors && errors.tags">{{ errors.trailer[0] }}</div>
        </div>
      </div>
    </div>
    <div style="padding: 1rem; background-color: #b39a76;" class="d-flex justify-content-end">
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="submit" v-on:click="clearAll" class="btn btn-custom2">Wyczyść</button>
        <button
          :disabled="form_submitting"
          type="submit"
          class="btn btn-custom2"
        >{{ form_submitting ? 'Sprawdzanie...' : 'Zapisz' }}</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  props: {
    user: Object,
  },
  data() {
    return {
      form_submitting: false,
      isBtnLoading: false,
      isBtnDisabled: false,
      btnStatus: "",
      movie: null,
      categories: [],
      fields: {
        title: "",
        user_id: "",
        release_date: "",
        poster: "",
        categories: [],
        description: "",
        imdb_rate: "",
        slider: "",
        trailer: "",
        fdb: "",
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
    console.log(this.user);
    axios.get("/api/categories").then((response) => {
      this.categories = response.data.data;
    });
  },
  methods: {
    submit() {
      this.form_submitting = true;
      const data = {
        ...this.fields,
        user_id: this.user.id,
        categories: this.getCategoriesIDs(),
      };
      axios
        .post("/api/movies", data)
        .then((response) => {
          this.form_submitting = false;
          this.movie = response.data;
          this.success = true;
          this.fields = { categories: [] };
          this.errors = {};
        })
        .catch((error) => {
          this.form_submitting = false;
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    clearAll(e) {
      e.preventDefault();
      this.fields = {};
      this.errors = {};
      this.error = false;
    },
    importData(e) {
      e.preventDefault();
      this.isBtnLoading = true;
      this.isBtnDisabled = true;
      this.errors = {};
      axios
        .post("/import", {
          title: this.fields.title,
        })
        .then((response) => {
          this.isBtnLoading = false;
          this.isBtnDisabled = false;
          this.error = false;
          this.fields = response.data;
        })
        .catch((error) => {
          this.error = true;
          this.isBtnLoading = false;
          this.isBtnDisabled = false;
        });
    },
    getCategoriesIDs() {
      return this.categories
        .filter((x) => this.fields.categories.includes(x.name))
        .map((y) => y.id);
    },
  },
  computed: {
    availableCategories() {
      const categories = this.categories.map((obj) => obj.name);
      return categories.filter(
        (opt) => this.fields.categories.indexOf(opt) === -1
      );
    },
  },
};
</script>