<template>
    <form method="POST" action="/filmy" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="title" class="col-md-3 col-form-label text-md-right font-weight-bold">Tytuł:</label>

            <div class="col-md-7">
                <div class="input-group">
                    <input id="title" type="text" v-model="title" class="form-control" name="title" required autocomplete="title" autofocus>
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
                <input id="year" type="number" v-model="year" class="form-control" name="year" required autocomplete="year" autofocus>
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
                <textarea class="form-control" v-model="description" name="desc" id="desc" placeholder="Opis filmu..." rows="6"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="categories" class="col-md-3 col-form-label text-md-right font-weight-bold">Kategoria:</label>

            <div class="col-md-7">
  
            </div>
        </div>
            <div class="form-group row">
                <label for="fdb" class="col-md-3 col-form-label text-md-right font-weight-bold">Fdb.pl ID:</label>

                <div class="col-md-7">
                    <input id="fdb" type="number" v-model="fdb" class="form-control" name="fdb" required autocomplete="fdb" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="rate" class="col-md-3 col-form-label text-md-right font-weight-bold">rate:</label>

                <div class="col-md-7">
                    <input id="rate" type="number" class="form-control" name="rate" required autocomplete="rate" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="view" class="col-md-3 col-form-label text-md-right font-weight-bold">view:</label>

                <div class="col-md-7">
                    <input id="view" type="number" class="form-control" name="view" required autocomplete="view" autofocus>
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
                status: 'Importuj',
                title: '',
                description: '',
                year: '',
                results: ''
            };
        },
        methods: {
            importData: function (e) {
                e.preventDefault();
                let currentObj = this;
                currentObj.status = 'Trwa importowanie...';
                axios.post('/ajaxtest', {
                    title: this.title
                })
                .then(function (response) {
                    console.log(response.data);
                    currentObj.status = 'Importuj';
                    currentObj.results = response.data;
                    currentObj.title = currentObj.results.title;
                    currentObj.description = currentObj.results.description;
                    currentObj.year = currentObj.results.year;
                    currentObj.fdb = currentObj.results.id;
                })
                .catch(function (error) {
                    console.log(error);
                    currentObj.results = error;
                });
            }
        }
    }

</script>
