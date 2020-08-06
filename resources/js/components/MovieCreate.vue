<template>
    <form method="POST" action="/filmy" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="title" class="col-md-3 col-form-label text-md-right font-weight-bold">Tytuł:</label>

            <div class="col-md-7">
                <div class="input-group">
                    <input id="title" type="text" v-model="fields.title" class="form-control" name="title" required autocomplete="title" autofocus>
                    <div class="input-group-append">
                        <button v-on:click="importData" class="btn btn-custom test">
                            {{ status }}
                        </button>
                    </div>
                </div>
            </div>  
        </div>
        <div class="form-group row">
            <label for="year" class="col-md-3 col-form-label text-md-right font-weight-bold">Rok:</label>

            <div class="col-md-7">
                <input id="year" type="number" v-model="fields.year" class="form-control" name="year" required autocomplete="year" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="thumb" class="col-md-3 col-form-label text-md-right font-weight-bold">Plakat:</label>

            <div class="col-md-7">
                <input type="file" class="form-control-file @error('thumb') is-invalid @enderror" name="thumb" id="thumb">
            </div>
        </div>
        <div class="form-group row">
            <label for="desc" class="col-md-3 col-form-label text-md-right font-weight-bold">Opis filmu:</label>

            <div class="col-md-7">
                <textarea class="form-control" v-model="fields.description" name="desc" id="desc" placeholder="Opis filmu..." rows="6"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="categories" class="col-md-3 col-form-label text-md-right font-weight-bold">Kategoria:</label>

            <div class="col-md-7">
                <select multiple size="10" v-model="fields.category" class="form-control" name="categories[]" id="categories">
                    <option v-for="category in categories" :key="category.id"
                        :value="category.id">{{ category.name }}
                    </option>
                </select>
            </div>
        </div>
            <div class="form-group row">
                <label for="fdb" class="col-md-3 col-form-label text-md-right font-weight-bold">Fdb.pl ID:</label>

                <div class="col-md-7">
                    <input id="fdb" type="number" v-model="fields.id" class="form-control" name="fdb" required autocomplete="fdb" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="rate" class="col-md-3 col-form-label text-md-right font-weight-bold">rate:</label>

                <div class="col-md-7">
                    <input id="rate" type="number" step="0.1" v-model="fields.rate" class="form-control" name="rate" required autocomplete="rate" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="view" class="col-md-3 col-form-label text-md-right font-weight-bold">view:</label>

                <div class="col-md-7">
                    <input id="view" type="number" v-model="fields.view" class="form-control" name="view" required autocomplete="view" autofocus>
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
                categories: null,
                fields: {category: []},
                errors: {},
                status: 'Importuj'
            };
        },
        mounted() {
            axios.get('/api/categories').then(response => {
                this.categories = response.data.data;
            })
        },
        methods: {
            submit() {
                axios.post('/api/movies', this.fields).then(response);
            },
            importData (e) {
                e.preventDefault();
                this.status = 'Trwa importowanie...';
                axios.post('/import', {
                    title: this.fields.title
                })
                .then((response) => {
                    console.log(response.data);
                    this.status = 'Importuj';
                    this.fields = response.data;
                    let category = this.fields.category;
                    this.fields.category = this.categories
                        .filter(
                            x=> this.fields.category
                        .includes(
                            x.name
                        ))
                        .map(
                            category => category.id
                        )
                })
                .catch((error) => {
                    console.log(error);
                    this.fields = error;
                });
            }
        }
    }

</script>
