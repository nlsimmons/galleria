<template>
    <div class="image-control">
        <div class="button-wrapper">
            <button type="button" class="button-bare" title="Rotate Left" v-on:click="rotateLeft">
                <i class="fas fa-undo"></i>
            </button>
            <button type="button" class="button-bare" title="Rotate Right" v-on:click="rotateLeft">
                <i class="fas fa-redo"></i>
            </button>
            <button type="button" class="button-bare" title="Add Tag">
                <i class="fas cs cs-tags"></i>
            </button>
            <button type="button" class="button-bare" title="Download" v-on:click="download">
                <i class="fas fa-arrow-alt-circle-down"></i>
            </button>
            <button type="button" class="button-bare button-delete-image" title="Delete" v-on:click="remove">
                <i class="fas fa-minus-circle"></i>
            </button>
        </div>
    </div>
</template>

<script>
const fn = require('../functions.js')

export default {
    data() {
        return {}
    },
    props: [
        'image_id', 'token'
    ],
    methods: {
        rotateLeft: function() {
            //
        },
        rotateRight: function() {
            //
        },
        remove: function() {
            if( confirm("Are you sure you want to delete this image?") )
            {
                let that = this
                fn.request('delete', `/api/images/${this.image_id}?api_token=${this.token}`)
                    .then( res => {
                        that.$emit('reload')
                        fn.notify('success', 'The image was deleted.')
                    } )
                    .catch( err => {
                        fn.notify('error', 'An error occurred.')
                        console.log( JSON.parse(err.response) )
                    })
            }
        },
        download: function() {
            //
        },
        tag: function() {
            //
        },
    }
}
</script>