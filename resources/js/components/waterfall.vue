<template>
    <div class="wrapper">
        <div class="waterfall">
            <div class="waterfall-column" v-for="column in columns">
                <waterfall-image v-for="image in column" :image="image" :columnClass="columnClass" v-bind:key="image.id" :token="token" :editable="editable">
                    <waterfall-image-buttons v-if="has_panel"
                        :image_id="image.id"
                        :token="token"
                        v-on:reload="fetchImages"
                    ></waterfall-image-buttons>
                </waterfall-image>
            </div>
        </div>
        <waterfall-panel v-if="has_panel" :token="token" :album="album" v-on:reload="fetchImages"></waterfall-panel>
    </div>
</template>

<script>
const fn = require('../functions.js')
import WaterfallImageButtons from './waterfall-image-buttons.vue'
import WaterfallImage from './waterfall-image.vue'
import Empty from './empty.vue'
// Need an on-resize

export default {
    data() {
        return {
            num_columns: 3,
            columns: [],
            is_empty: false,
        }
    },
    components: {
        WaterfallImageButtons, WaterfallImage, Empty
    },
    props: [
        'src', 'token', 'has_panel', 'album', 'editable'
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
                    console.log(res)
                    return JSON.parse(res.response)
                } )
                .then( images => {
                    console.log(images)

                    if(images.length)
                        this.processImages(images)
                    else
                        this.is_empty = true
                } )
                .catch( err => {
                    console.log(err)
                } )
        },
        processImages(images) {
            this.is_empty = false
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
