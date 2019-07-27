<template>
    <div class="wrapper">
        <div class="waterfall">
            <div class="waterfall-column" v-for="column in columns">
                <WaterfallImage v-for="image in column" :image="image" :columnClass="columnClass" :token="token"
                    v-bind:key="image.id">
                    <Buttons v-if="typeof token != 'undefined'"
                        :image_id="image.id"
                        :token="token"
                        v-on:reload="fetchImages"
                    ></Buttons>
                </WaterfallImage>
            </div>
        </div>
        <Panel v-if="has_panel" :token="token" :album="album" v-on:reload="fetchImages"></Panel>
    </div>
</template>

<script>
const fn = require('../functions.js')
import Buttons from './Buttons.vue'
import WaterfallImage from './WaterfallImage.vue'
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
        Buttons, WaterfallImage
    },
    props: [
        'src', 'token', 'has_panel', 'album'
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

            let params = {}
            let uri = `/api/images/${this.src}`
            if( typeof this.token != 'undefined' )
                params.api_token = this.token

            fn.request('get', uri, params)
                .then( res => {
                    return JSON.parse(res.response)
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
