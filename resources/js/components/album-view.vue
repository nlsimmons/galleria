<template>
    <div id="album-carousel" class="hero is-info" :class="{ 'inactive': hidden }">
        <div class="container">
            <div class="carousel" id="carousel-albums">
                <input v-for="album in albums" :id="'slide_' + album.id"
                    :checked="album.id == active"
                    type="radio" name="activator-carousel-albums"
                    class="carousel-activator">
                <input type="radio" name="activator-carousel-albums"
                    id="slide_new" class="carousel-activator">

                <div v-for="album in albums"
                    class="carousel-controls">
                    <label class="carousel-previous" :for="album.prev">
                        <i class="fas fa-chevron-circle-left"></i>
                    </label>
                    <label class="carousel-next" :for="album.next">
                        <i class="fas fa-chevron-circle-right"></i>
                    </label>
                </div>
                <div class="carousel-controls">
                    <label class="carousel-previous" :for="new_prev">
                        <i class="fas fa-chevron-circle-left"></i>
                    </label>
                    <label class="carousel-next" :for="new_next">
                        <i class="fas fa-chevron-circle-right"></i>
                    </label>
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
            new_prev: null,
            new_next: null,
        }
    },
    components: {
        AlbumSlide
    },
    props: [
        'token', 'active'
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
                    this.albums = albums
                } )
                .then( _ => {
                    this.setControls()
                } )
                .catch( err => {
                    console.log(err)
                    console.log(err.response, err.responseURL)
                } )
        },
        toggleAlbumView() {
            this.hidden = ! this.hidden
        },
        setControls() {
            let ids = []
            fn.qsa("input[type=radio][name=activator-carousel-albums]")
                .forEach(e => {
                    ids.push( e.id )
                })
            let prev_ids = ids.slice(0)
                prev_ids.unshift( prev_ids.pop() )
            let next_ids = ids.slice(0)
                next_ids.push( next_ids.shift() )

            for(let album of this.albums)
            {
                album.prev = prev_ids.shift()
                album.next = next_ids.shift()
            }
            this.new_prev = prev_ids.shift()
            this.new_next = next_ids.shift()

            if( !this.active )
                fn.qs('#' + this.new_next).checked = true
        }
    },
    beforeMount() {
        this.fetchAlbums()
    },
}
</script>
