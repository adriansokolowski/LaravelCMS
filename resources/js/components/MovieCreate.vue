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
            <label for="year" class="col-md-3 col-form-label text-md-right font-weight-bold">Rok:</label>

            <div class="col-md-7">
                <input id="year" type="number" v-model="fields.year" class="form-control" name="year" required autocomplete="year" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.year">
                    {{ errors.year[0] }}
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
            <label for="description" class="col-md-3 col-form-label text-md-right font-weight-bold">Opis filmu:</label>

            <div class="col-md-7">
                <textarea class="form-control" v-model="fields.description" name="description" placeholder="Opis filmu..." rows="6"></textarea>
                <div class="alert alert-danger" v-if="errors && errors.poster">
                    {{ errors.description[0] }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="categories" class="col-md-3 col-form-label text-md-right font-weight-bold">Kategoria:</label>

            <div class="col-md-7">
                <select multiple size="10" v-model="fields.categories" class="form-control" name="categories[]" id="categories">
                    <option v-for="category in categories" :key="category.id"
                        :value="category.id">{{ category.name }}
                    </option>
                </select>
            </div>
        </div>
            <div class="form-group row">
                <label for="fdb" class="col-md-3 col-form-label text-md-right font-weight-bold">Fdb.pl ID:</label>

                <div class="col-md-7">
                    <input id="fdb" type="number" v-model="fields.fdb" class="form-control" name="fdb" required autocomplete="fdb" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="rate" class="col-md-3 col-form-label text-md-right font-weight-bold">Ocena:</label>

                <div class="col-md-7">
                    <input id="rate" type="number" step="0.1" v-model="fields.rate" class="form-control" name="rate" autocomplete="rate" autofocus>
                    <div class="alert alert-danger" v-if="errors && errors.rate">
                        {{ errors.rate[0] }}
                    </div>
                </div>
            </div>
            <div class="form-group row">
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
        data() {
            return {
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
            axios.get('/api/categories').then(response => {
                this.categories = response.data.data;
            })
        },
        methods: {
            submit() {
                axios.post('/api/movies', this.fields).then(response => {
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
