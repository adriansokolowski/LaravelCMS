<template>
    <form @submit.prevent="submit">
    <div class="alert alert-success text-center" v-show="success" role="alert">
        Film został dodany. <a :href="movie">Przejdź</a>
    </div>
    <div class="alert alert-danger text-center" v-show="error" role="alert">
        Nie znaleziono filmu o podanym tytule.
    </div>
        <div class="form-group row">
            <label for="title" class="col-md-3 col-form-label text-md-right font-weight-bold">Tytuł:</label>

            <div class="col-md-7">
                <div class="input-group">
                    <input id="title" type="text" v-model="fields.title" :class="{ 'is-invalid' : errors && errors.title}" class="form-control" name="title" required autocomplete="title" autofocus>
                    <div class="input-group-append">
                        <button v-on:click="importData" class="btn btn-custom test">
                            {{ status }}
                        </button>
                    </div>
                    <span class="invalid-feedback" v-if="errors && errors.title" role="alert">
                        <strong>{{ errors.title[0] }}</strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="release_date" class="col-md-3 col-form-label text-md-right font-weight-bold">Premiera:</label>

            <div class="col-md-7">
                <input id="release_date" type="date" v-model="fields.release_date" class="form-control" name="release_date" required autocomplete="release_date" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.release_date">
                    {{ errors.release_date[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="poster" class="col-md-3 col-form-label text-md-right font-weight-bold">Plakat:</label>

            <div class="col-md-7">
                <input id="poster" type="text" v-model="fields.poster" class="form-control" name="poster" required autocomplete="poster" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.poster">
                    {{ errors.poster[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-3 col-form-label text-md-right font-weight-bold">Opis:</label>

            <div class="col-md-7">
                <textarea class="form-control" v-model="fields.description" name="description" placeholder="Opis filmu..." rows="6"></textarea>
                <div class="alert alert-danger" v-if="errors && errors.poster">
                    {{ errors.description[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="categories" class="col-md-3 col-form-label text-md-right font-weight-bold">Kategorie:</label>

            <div class="col-md-7">
                <select multiple size="10" v-model="fields.categories" class="form-control" name="categories[]" id="categories">
                    <option v-for="category in categories" :key="category.id"
                        :value="category.id">{{ category.name }}
                    </option>
                </select>
            </div>
        </div>
            <h5 v-on:click="expand" class="font-weight-bold">Opcje zaawansowane:</h5>
            <i :class="[advanced ? 'fa-chevron-up' : 'fa-chevron-down', 'fa']"></i>
            <i class="fa fa-chevron-down"></i>

            <div class="form-group row" v-show="advanced">
                <label for="fdb" class="col-md-3 col-form-label text-md-right font-weight-bold">Fdb.pl ID:</label>

                <div class="col-md-7">
                    <input id="fdb" type="number" v-model="fields.fdb" class="form-control" name="fdb" required autocomplete="fdb" autofocus>
                </div>
            </div>
            <div class="form-group row" v-show="advanced">
                <label for="imdb_rate" class="col-md-3 col-form-label text-md-right font-weight-bold">Ocena:</label>

                <div class="col-md-7">
                    <input id="imdb_rate" type="number" step="0.1" v-model="fields.imdb_rate" class="form-control" name="imdb_rate" autocomplete="imdb_rate" autofocus>
                    <div class="alert alert-danger" v-if="errors && errors.imdb_rate">
                        {{ errors.imdb_rate[0] }}
                    </div>
                </div>
            </div>
            <div class="form-group row" v-show="advanced">
                <label for="view" class="col-md-3 col-form-label text-md-right font-weight-bold">Wyświetlenia:</label>

                <div class="col-md-7">
                    <input id="view" type="number" v-model="fields.view" class="form-control" name="view" autocomplete="view" autofocus>
                    <div class="alert alert-danger" v-if="errors && errors.view">
                        {{ errors.view[0] }}
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
                advanced: false,
                movie: null,
                categories: null,
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
            })
        },
        methods: {
            submit() {
                this.fields.user_id = this.user.id;
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
                this.status = 'Trwa importowanie...';
                axios.post('/import', {
                    title: this.fields.title
                })
                .then((response) => {
                    this.error = false;
                    this.status = 'Importuj';
                    this.fields = response.data;
                    this.fields.categories = this.categories.filter(x=> this.fields.categories.includes(x.name)).map(categories => categories.id)
                })
                .catch((error) => {
                    this.status = 'Importuj';
                    this.error = true;
                });
            }
        }
    }

</script>
