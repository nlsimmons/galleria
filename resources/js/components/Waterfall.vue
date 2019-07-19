<template>
    <div class="waterfall">
        <div class="waterfall-column" v-for="column in columns">
            <div class="waterfall-image" v-for="image in column">
                <div class="image-wrapper">
                <!-- <a href="{{ url( $image->album_link() ) }}" target="_blank"> -->
                        <img :src="image.image_url" :title="image.title" :class="columnClass">
                <!-- </a> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const fn = require('../functions.js')

// Need an on-resize

export default {
    data() {
        return {
            images: [],
            num_columns: 3,
            columns: [],

        }
    },
    computed: {
        columnClass: function() {
            return 'width-' + this.num_columns + '-cols'
        }
    },
    watch: {
        images: function() {
            let n = 0
            let columns = []
            for( let i=0; i<this.num_columns; i++ )
                columns[i] = []
            this.images.forEach( img => {
                columns[n++].push(img)
                if( n >= this.num_columns ) n = 0
            } )
            this.columns = columns
        },
    },
    methods: {
        fetchImages: function() {
            if( window.innerWidth < 600 )
                this.num_columns = 1
            else if( window.innerWidth < 1200 )
                this.num_columns = 2
            else
                this.num_columns = 3

            fn.request('get', '/api/welcome_images?size=500')
                .then( res => {
                    return JSON.parse(res)
                } )
                .then( images => {
                    this.images = images
                } )
        }
    },
    beforeMount() {
        this.fetchImages()
    },
}
</script>
