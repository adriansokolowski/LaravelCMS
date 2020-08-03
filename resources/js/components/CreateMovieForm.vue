<template>
                <div class="form-group row">
                    {{output}}
                <label for="title" class="col-md-3 col-form-label text-md-right">Tytuł: *</label>

                <div class="col-md-5">
                    <input id="title" type="text" v-model="title" class="form-control" name="title" required autocomplete="title" autofocus>
                </div>
                <div class="col-md-2">
                    <button v-on:click="get" class="btn btn-custom test">
                        Import
                    </button>
                </div>
            </div>
</template>

<script>
    export default {
        data() {
            return {
              title: '',
              output: ''
            };
        },
        methods: {
            get: function (e) {
                e.preventDefault();
                let currentObj = this;
                axios.post('/ajaxtest', {
                    title: this.title
                })
                .then(function (response) {
                    console.log(response);
                    currentObj.output = response.data;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }

</script>
