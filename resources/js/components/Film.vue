<template>
    <li class="list-group-item">
        <a :href="fullUrl" target="_blank">
            {{ film.name }}
        </a>
        <span>{{ publishedDate }}</span>
    </li>
</template>

<script>
    import moment from 'moment';

    export default {
        props: {
            film: {
                type: Object,
                required: true
            }
        },

        mounted () {
            console.log(this.film);
        },

        computed: {
            fullUrl () {
                return `https://www.lostfilm.tv/${this.film.url}`
            },

            publishedDate () {
                return moment(this.published_at).format('DD-MM-YYYY')
            }
        }
    }
</script>
