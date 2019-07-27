<template>
    <div class="waterfall-image">
        <div class="image-wrapper" v-on:click="expand">
            <img :src="url" :title="image.title" :class="columnClass">
        </div>
        <slot />
        <div class="modal expanded-image is-active" v-if="expanded">
            <div class="modal-background"></div>
            <div class="modal-content">
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
    props: ['image', 'columnClass'],
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
        }
    },
}
</script>
