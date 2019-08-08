<template>
    <div id="album-carousel" class="hero is-info" :class="{ 'inactive': hidden }">
        <div class="container">
            <div class="carousel" id="carousel-albums">
                <input v-for="album in albums" :key="album.id"
                    type="radio"
                    class="carousel-activator"
                    name="activator-carousel-albums">
                <div v-for="album in albums"
                    class="carousel-controls">
                        <!-- <label for="{{ $slide->previous }}" class="carousel-previous">
                            <i class="fas fa-chevron-circle-left"></i>
                        </label>
                        <label for="{{ $slide->next }}" class="carousel-next">
                            <i class="fas fa-chevron-circle-right"></i>
                        </label> -->
                </div>
                <div class="carousel-track">
                    <album-slide v-for="album in albums"
                        :token="token"
                        :album="album"
                        :key="album.id" />
                    <div class="carousel-slide">
                        <form method="post" action="/album/new" class="items-centered slide-content new-album">
                            <slot />
                            <button type="submit" class="button-bare" title="Create New Album">
                                <i class="fas fa-plus is-size-1"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div v-on:click="toggleAlbumView"
            id="toggle-album-carousel">
            <i class="fas fa-angle-double-down" v-if="hidden"></i>
            <i class="fas fa-angle-double-up" v-else></i>
        </div>

    </div>
</template>

<script>
const fn = require('../functions.js')
import AlbumSlide from './album-slide.vue'

export default {
    data() {
        return {
            albums: [],
            hidden: false,
        }
    },
    components: {
        AlbumSlide
    },
    props: [
        'token'
    ],
    computed: {
        //
    },
    methods: {
        fetchAlbums() {
            let that = this
            let params = {}
            let uri = `/api/albums`
            if( typeof this.token != 'undefined' )
                params.api_token = this.token

            fn.request('get', uri, params)
                .then( res => {
                    return JSON.parse(res.response)
                } )
                .then( albums => {
                    that.albums = albums
                } )
                .catch( err => {
                    console.log(err.response, err.responseURL)
                } )
        },
        toggleAlbumView() {
            this.hidden = ! this.hidden
        }
    },
    beforeMount() {
        this.fetchAlbums()
    },
}
</script>
