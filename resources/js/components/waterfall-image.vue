<template>
    <div class="waterfall-image">
        <div class="image-wrapper" v-on:click="expand">
            <img :src="url" :title="image.title" :class="columnClass">
        </div>
        <slot />
        <div class="modal expanded-image is-active" v-if="expanded">
            <div class="modal-background"></div>
            <div class="modal-content expanded-image-container">
                <div class="image-title-wrapper">
                    <input v-if="editable" type="text" placeholder="Click to add a title to this image" :value="image.title" v-on:change="changeTitle($event)">
                    <input v-else-if="image.title" type="text" :value="image.title" readonly>
                </div>
                <!-- <div class="image-desc-wrapper"> -->
                    <!-- <textarea v-if="editable" placeholder="Click to add a description"></textarea> -->
                    <!-- <p v-if="image.description">{{ image.description }}</p> -->
                <!-- </div> -->
                <img :src="expanded_url">
                <a href="#" style="position: absolute;
                                   font-size: 1rem;
                                   float: left;
                                   left: 0;
                                   bottom: -2rem;">See more in this album</a>
               <button class="modal-close is-large" v-on:click="unexpand"></button>
            </div>
        </div>
    </div>
</template>

<script>
const fn = require('../functions.js')

export default {
    data() {
        return {
            expanded: false
        }
    },
    created() {
        let that = this
        // console.log(this.image)
        window.addEventListener('keydown', e => {
            if(that.expanded && e.code == 'Escape')
                that.expanded = false
        })
    },
    props: ['image', 'columnClass', 'editable', 'token'],
    computed: {
        url: function() {
            return this.image.image_url + '/650'
        },
        expanded_url: function() {
            return this.image.image_url + '/1500'
        }
    },
    methods: {
        alert: function(e) {
            console.log(e)
            alert(e)
        },
        expand: function() {
            this.expanded = true
        },
        unexpand: function() {
            this.expanded = false
        },
        changeTitle(e) {
            this.image.title = e.target.value
            let params = {
                api_token: this.token,
                new_title: this.image.title
            }
            let uri = `/api/images/${this.image.id}/title`
            fn.request('put', uri, params)
                .then(res => {
                    fn.notify('success', 'Title successfully changed')
                })
                .catch(err => {
                    console.log(err)
                })
        },
    },
}
</script>
