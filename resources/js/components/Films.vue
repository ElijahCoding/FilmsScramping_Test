<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Films</div>

                    <div class="card-body">
                        <ul class="list-group">
                            <film v-if="films.length"
                                  v-for="film in films"
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
                films: []
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
        }
    }
</script>
