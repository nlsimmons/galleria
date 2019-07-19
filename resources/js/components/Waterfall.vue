<template>
    <div class="waterfall">
        <div class="waterfall-column" v-for="column in columns">
            <div class="waterfall-image" v-for="image in column">
                <div class="image-wrapper">
                <!-- <a href="{{ url( $image->album_link() ) }}" target="_blank"> -->
                    <img :src="image.image_url" :title="image.title" :class="columnClass">
                    <Buttons v-if="typeof token != 'undefined'"
                        :image_id="image.id"
                        :token="token"
                        v-on:reload="fetchImages"
                    ></Buttons>
                <!-- </a> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const fn = require('../functions.js')
import Buttons from './Buttons.vue'
// Need an on-resize

export default {
    data() {
        return {
            images: [],
            num_columns: 3,
            columns: [],
        }
    },
    components: {
        Buttons
    },
    props: [
        'src', 'token'
    ],
    computed: {
        columnClass: function() {
            return 'width-' + this.num_columns + '-cols'
        }
    },
    watch: {
        //
    },
    methods: {
        fetchImages: function() {
            if( window.innerWidth < 600 )
                this.num_columns = 1
            else if( window.innerWidth < 1200 )
                this.num_columns = 2
            else
                this.num_columns = 3

            let uri = `/api/images/${this.src}?size=500`
            if( typeof this.token != 'undefined' )
                uri += '&api_token=' + this.token

            fn.request('get', uri)
                .then( res => {
                    return JSON.parse(res)
                } )
                .then( images => {
                    this.processImages(images)
                } )
                .catch( err => {
                    console.log(err)
                } )
        },
        processImages(images) {
            let n = 0
            let columns = []
            for( let i=0; i<this.num_columns; i++ )
                columns[i] = []

            images.forEach( img => {
                columns[n++].push(img)
                if( n >= this.num_columns ) n = 0
            } )
            this.columns = columns
        }
    },
    beforeMount() {
        if( typeof this.src == 'undefined' )
            throw "Source not defined"

        this.fetchImages()
    },
}
</script>
