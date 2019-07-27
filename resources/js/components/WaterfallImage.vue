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
                    <input type="text" placeholder="Click to add a title to this image" :value="image.title" v-on:change="changeTitle($event)">
                </div>
                <img :src="expanded_url" loading="eager">
                <button class="modal-close is-large" v-on:click="unexpand"></button>
            </div>
        </div>
    </div>
</template>

<script>
const fn = require('../functions.js')

export default {
    name: 'WaterfallImage',
    data() {
        return {
            expanded: false
        }
    },
    props: ['image', 'columnClass', 'token'],
    computed: {
        url: function() {
            return this.image.image_url + '/650'
        },
        expanded_url: function() {
            return this.image.image_url
        }
    },
    methods: {
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
        }
    },
}
</script>
