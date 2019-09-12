<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Films</div>

                    <div class="card-body">
                        <input class="form-control py-2"
                               type="search"
                               placeholder="Search"
                               v-model="query"
                           >
                        <ul class="list-group">
                            <film v-if="filteredFilms.length"
                                  v-for="film in filteredFilms"
                                  :film="film"
                                  :key="film.id"
                                  />
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Film from './Film';

    export default {
        data () {
            return {
                films: [],
                query: ''
            }
        },

        components: {
            Film
        },

        mounted() {
            this.fetchFilms()
        },

        methods: {
            fetchFilms () {
                axios.get('/api/films').then(({ data }) => {
                    this.films = data.data
                })
            }
        },

        computed: {
            filteredFilms () {
                let data = this.films;

                data = data.filter(row => {
                  return Object.keys(row).some(key => {
                    return (
                      String(row[key])
                        .toLowerCase()
                        .indexOf(this.query.toLowerCase()) > -1
                    );
                  });
                });

                return data;
            }
        }
    }
</script>
