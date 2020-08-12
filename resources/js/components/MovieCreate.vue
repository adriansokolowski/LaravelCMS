<template>

    <form @submit.prevent="submit">
    <div class="alert alert-success text-center" v-show="success" role="alert">
        Film został dodany. <a :href="movie">Przejdź</a>
    </div>
        <div class="form-group row">
            <label for="title" class="col-md-3 col-form-label text-md-right font-weight-bold">Tytuł</label>

            <div class="col-md-7">
                <div class="input-group">
                    <input id="title" type="text" v-model="fields.title" :class="{ 'is-invalid' : (errors && errors.title) || (error)}" class="form-control" required autocomplete="title" autofocus>
                    <div class="input-group-append">
                        <button v-on:click="importData" class="btn btn-custom test">
                            {{ status }}
                        </button>
                    </div>
                    <span class="invalid-feedback" v-if="errors && errors.title" role="alert">
                        <strong>{{ errors.title[0] }}</strong>
                    </span>
                    <span class="invalid-feedback" v-if="error" role="alert">
                        <strong>Brak wyników dla {{ this.fields.title }}</strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="release_date" class="col-md-3 col-form-label text-md-right font-weight-bold">Premiera</label>

            <div class="col-md-7">
                <input id="release_date" type="date" v-model="fields.release_date" class="form-control" required autocomplete="release_date" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.release_date">
                    {{ errors.release_date[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="poster" class="col-md-3 col-form-label text-md-right font-weight-bold">Plakat</label>

            <div class="col-md-7">
                <input id="poster" type="text" v-model="fields.poster" class="form-control" required autocomplete="poster" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.poster">
                    {{ errors.poster[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-3 col-form-label text-md-right font-weight-bold">Opis</label>

            <div class="col-md-7">
                <textarea class="form-control" v-model="fields.description" placeholder="Opis filmu..." rows="6"></textarea>
                <div class="alert alert-danger" v-if="errors && errors.poster">
                    {{ errors.description[0] }}
                </div>
            </div>
        </div>
        <!-- <div class="form-group row">
            <label for="categories" class="col-md-3 col-form-label text-md-right font-weight-bold">Kategorie</label>

            <div class="col-md-7">
                <select multiple size="10" v-model="fields.categories" class="form-control" id="categories">
                    <option v-for="category in categories" :key="category.id"
                        :value="category.id">{{ category.name }}
                    </option>
                </select>
            </div>
        </div> -->
        <div class="form-group row">
            <label for="categories" class="col-md-3 col-form-label text-md-right font-weight-bold">Kategorie</label>

            <div class="col-md-7">
                <multi-select track-by="id" label="name" v-model="fields.categories" :options="categories" :multiple="true"></multi-select>
            </div>
        </div>
        <div class="form-group row">
            <label for="slider" class="col-md-3 col-form-label text-md-right font-weight-bold">Zdjęcie</label>

            <div class="col-md-7">
                <input id="slider" type="number" v-model="fields.slider" class="form-control" autocomplete="slider" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.slider">
                    {{ errors.slider[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="fdb" class="col-md-3 col-form-label text-md-right font-weight-bold">Fdb.pl ID</label>

            <div class="col-md-7">
                <input id="fdb" type="number" v-model="fields.fdb" class="form-control" required autocomplete="fdb" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Zwiastun</label>

            <div class="col-md-7">
                <input id="trailer" type="number" v-model="fields.trailer" class="form-control" autocomplete="trailer" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.trailer">
                    {{ errors.trailer[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Reżyseria</label>

            <div class="col-md-7">
                <input id="trailer" type="number" v-model="fields.trailer" class="form-control" autocomplete="trailer" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.trailer">
                    {{ errors.trailer[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Scenariusz</label>

            <div class="col-md-7">
                <input id="trailer" type="number" v-model="fields.trailer" class="form-control" autocomplete="trailer" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.trailer">
                    {{ errors.trailer[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Kraj</label>

            <div class="col-md-7">
                <input id="trailer" type="number" v-model="fields.trailer" class="form-control" autocomplete="trailer" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.trailer">
                    {{ errors.trailer[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Obsada</label>

            <div class="col-md-7">
                <input id="trailer" type="number" v-model="fields.trailer" class="form-control" autocomplete="trailer" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.trailer">
                    {{ errors.trailer[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="trailer" class="col-md-3 col-form-label text-md-right font-weight-bold">Tag</label>

            <div class="col-md-7">
                <input id="trailer" type="number" v-model="fields.trailer" class="form-control" autocomplete="trailer" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.trailer">
                    {{ errors.trailer[0] }}
                </div>
            </div>
        </div>
        <h5 v-on:click="expand" class="font-weight-bold">Zaawansowane</h5>
        <i :class="[advanced ? 'fa-chevron-up' : 'fa-chevron-down', 'fa']"></i>
        <i class="fa fa-chevron-down"></i>
        <div class="form-group row" v-show="advanced">
            <label for="imdb_rate" class="col-md-3 col-form-label text-md-right font-weight-bold">Ocena</label>

            <div class="col-md-7">
                <input id="imdb_rate" type="number" step="0.1" v-model="fields.imdb_rate" class="form-control" autocomplete="imdb_rate" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.imdb_rate">
                    {{ errors.imdb_rate[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row" v-show="advanced">
            <label for="views" class="col-md-3 col-form-label text-md-right font-weight-bold">Wyświetlenia</label>

            <div class="col-md-7">
                <input id="views" type="number" v-model="fields.views" class="form-control" autocomplete="views" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.views">
                    {{ errors.views[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row" v-show="advanced">
            <label for="up" class="col-md-3 col-form-label text-md-right font-weight-bold">Łapki w góre</label>

            <div class="col-md-7">
                <input id="up" type="number" v-model="fields.up" class="form-control" autocomplete="up" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.up">
                    {{ errors.up[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row" v-show="advanced">
            <label for="down" class="col-md-3 col-form-label text-md-right font-weight-bold">Łapki w dół</label>

            <div class="col-md-7">
                <input id="down" type="number" v-model="fields.down" class="form-control" autocomplete="down" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.down">
                    {{ errors.down[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row" v-show="advanced">
            <label for="html" class="col-md-3 col-form-label text-md-right font-weight-bold">Html</label>

            <div class="col-md-7">
                <textarea class="form-control" v-model="fields.html" rows="6"></textarea>
                <div class="alert alert-danger" v-if="errors && errors.html">
                    {{ errors.html[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4 text-right">
                <button type="submit" class="btn btn-custom">
                    Zapisz
                </button>
            </div>
        </div>


    </form>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                value: [{'id': 6, 'name':'Dramat'}],
                advanced: false,
                movie: null,
                categories: [],
                fields: {categories: []},
                status: 'Importuj',
                success: false,
                error: false,
                errors: {}
            };
        },
        mounted() {
            this.fields.user_id = this.user.id;
            axios.get('/api/categories').then(response => {
                this.categories = response.data.data;
                this.options = response.data.data;

                console.log(this.categories);
            })
        },
        methods: {
            submit() {
                this.fields.user_id = this.user.id;
                this.fields.categories = this.fields.categories.map(a => a.id);
                console.log(this.fields.categories);
                axios.post('/api/movies', this.fields).then(response => {
                    console.log(this.fields);
                    this.movie = response.data;
                    this.success = true;
                    this.fields = {categories: []};
                    this.errors = {};
                }).catch(error => {
                    if (error.response.status == 422){
                        this.errors = error.response.data.errors;
                    }
                });
            },
            expand (e) {
                e.preventDefault();
                this.advanced ? this.advanced = false : this.advanced = true;
            },
            importData (e) {
                e.preventDefault();
                this.errors = {};
                this.status = 'Trwa importowanie...';
                axios.post('/import', {
                    title: this.fields.title
                })
                .then((response) => {
                    this.error = false;
                    this.status = 'Importuj';
                    this.fields = response.data;
                    this.fields.categories = this.categories.filter(x=> this.fields.categories.includes(x.name));
                    console.log(this.fields.categories);
                })
                .catch((error) => {
                    this.status = 'Importuj';
                    this.error = true;
                });
            }
        }
    }

</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>