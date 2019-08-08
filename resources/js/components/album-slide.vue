<template>
    <div class="carousel-slide">
        <a class="slide-content"
            :href="href"
            :title="title">
            <div class="album-cover" :style="cover"></div>
        </a>
        <div class="click-menu">
            <i class="menu-toggle fas fa-bars" :class="{ active: menu_active }" v-on:click="toggleMenu"></i>
            <ul class="click-menu-items">
                <li class="click-menu-item" v-on:click="changeTitle">Change album title</li>
                <li class="click-menu-item" v-on:click="deleteAlbum">Delete this album</li>
                <li class="click-menu-item" v-on:click="changeCover">Change cover photo</li>
            </ul>
        </div>
        <div class="albumview-indicator"></div>
    </div>
</template>

<script>
const fn = require('../functions.js')

export default {
    data() {
        return {
            menu_active: false
        }
    },
    props: [
        'album', 'token'
    ],
    computed: {
        href() {
            return "/album/" + this.album.id
        },
        title() {
            return this.album.title || 'Untitled Album'
        },
        cover() {
            return { 'background-image': 'url(' + this.album.cover_image + ')' }
        },
    },
    methods: {
        toggleMenu() {
            this.menu_active = ! this.menu_active
        },
        changeTitle() {
            let old_title = this.album.title || ''
            let new_title = prompt("Enter a new album title", old_title)
            if( !new_title )
                return

            let data = { title: new_title, api_token: this.token }
            let uri = `/api/albums/${this.album.id}/title`
            fn.request('put', uri, data)
                .then( res => {
                    // refresh this, or at least change the title on the element
                })
                .catch( err => {
                    console.log(err)
                })
        },
        deleteAlbum() {
            if( !confirm("Are you sure you want to delete this album?") )
                return
            let uri = `/api/albums/${this.album.id}?api_token=${this.token}`
            fn.request('delete', uri)
                .then( res => {
                    window.location.reload()
                })
                .catch( err => {
                    console.log(err)
                })
        },
        changeCover() {
            //
        },
    },
}
</script>
