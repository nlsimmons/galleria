<template>
    <div class="image-control" :id="buttons_id">
        <div class="button-wrapper">
            <div class="dropdown is-up tag-menu" :id="tagMenuId">
                <button type="button" class="button-bare" title="Add a Tag" v-on:click="tagMenu">
                    <i class="fas cs cs-tags"></i>
                </button>
                <div class="dropdown-menu">
                    <div class="dropdown-content">
                        <div href="#" class="dropdown-item">
                            <div class="control has-icons-right">
                                <input class="input" type="text" placeholder="Text input">
                                <span class="icon is-small is-right">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Tag 1</a>
                        <a href="#" class="dropdown-item">Tag 2</a>
                    </div>
                </div>
            </div>

            <div class="dropdown is-up album-menu" :id="albumMenuId">
                <button type="button" class="button-bare" title="Move/Add to Album" v-on:click="albumMenu">
                    <i class="fas fa-images"></i>
                </button>
                <div class="dropdown-menu">
                    <div class="dropdown-content">
                        <div href="#" class="dropdown-item">
                            <div class="control has-icons-right">
                                <input class="input" type="text" placeholder="Text input">
                                <span class="icon is-small is-right">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Tag 1</a>
                        <a href="#" class="dropdown-item">Tag 2</a>
                    </div>
                </div>
            </div>

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
    computed: {
        tagMenuId: function() {
            return 'tag-menu-' + this.image_id
        },
        albumMenuId: function() {
            return 'album-menu-' + this.image_id
        },
        drop_id: function() {
            return 'drop-id-' + this.image_id
        },
        buttons_id: function() {
            return 'buttons-id-' + this.image_id
        }
    },
    methods: {
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
        tagMenu: function() {
            fn.toggleElement( fn.qs('#' + this.tagMenuId), 'is-active' )
        },
        albumMenu: function() {
            fn.toggleElement( fn.qs('#' + this.albumMenuId), 'is-active' )
        },
    }
}
</script>