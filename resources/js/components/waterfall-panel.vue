<template>
    <div class="user-panel items-centered">
        <div class="upload">
            <div v-if="preview_images.length" class="image-preview">
                <div class="buttons">
                    <i class="fas fa-arrow-circle-up" title="Upload" v-on:click="confirm"></i>
                </div>
                <div v-for="image in preview_images" class="image-wrapper">
                    <img :src="'/upload/images/tmp/' + image.src">
                </div>
                <div class="buttons">
                    <i class="fas fa-ban" title="Cancel" v-on:click="cancel"></i>
                    <i class="far fa-images" title="Add to Album"></i>
                </div>
            </div>
            <label class="button" v-else>
                <input type="file" class="hidden" multiple
                    ref="uploads" v-on:change="upload">
                Upload Images
            </label>
        </div>
    </div>
</template>

<script>
const fn = require('../functions.js')
const EXIF = require('exif-js')

export default {
    data() {
        return {
            preview_images: [],
            agent: navigator.userAgent
        }
    },
    props: [
        'token', 'album'
    ],
    computed: {

    },
    methods: {
        upload() {
            if(this.agent.indexOf('Mobile') !== -1)
                return this.uploadMobile()

            let files = this.$refs.uploads.files
            let that = this
            for(let file of files)
            {
                fn.request('post', '/api/images/upload', {
                    api_token: this.token,
                    image: file,
                })
                .then( res => {
                    return JSON.parse(res.response)
                })
                .then( img => {
                    that.preview_images.push(img)
                })
                .catch( err => {
                    console.log(err)
                })
            }
        },
        uploadMobile() {
            let that = this
            let files = this.$refs.uploads.files
            for( let file of files)
            {
                let params = {
                    api_token: this.token,
                    image: file,
                    album: this.album || null
                };

                // console.log(params)
                fn.request('post', '/api/images/uploaddirect', params).then(res => {
                    that.$emit('reload')
                    fn.notify('success', 'Image(s) uploaded successfully.')
                    console.log(res.response)
                    return JSON.parse(res.response)
                })
                .then(res => {
                    // console.log(res)
                })

            }
        },
        confirm() {
            let that = this
            for(let image of this.preview_images)
            {
                fn.request('post', `/api/images/confirm/${image.src}`, {
                    api_token: this.token,
                    album: this.album || null
                }).then(res => {
                        that.$emit('reload')
                        fn.notify('success', 'Image(s) uploaded successfully.')
                        that.preview_images = []
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        },
        cancel() {
            this.preview_images = []
        },
    },
}
</script>
