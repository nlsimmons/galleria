<template>
    <div class="user-panel items-centered">
        <div class="upload">
            <div v-if="preview_images.length" class="image-preview">
                <div class="buttons">
                    <i class="fas fa-arrow-circle-up" title="Upload"></i>
                </div>
                <div v-for="image in preview_images" class="image-wrapper">
                    <img :src="'/upload/images/tmp/' + image.src">
                </div>
                <div class="buttons">
                    <i class="fas fa-ban" title="Cancel"></i>
                    <i class="far fa-images" title="Add to Album"></i>
                </div>
            </div>
            <label class="button" v-else>
                <input type="file" class="hidden" multiple
                    ref="uploads" v-on:change="preupload">
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
        }
    },
    props: [
        'token',
    ],
    computed: {

    },
    methods: {
        preupload() {
            let files = this.$refs.uploads.files
            let that = this
            for(let file of files)
            {
                fn.request('post', '/api/images/preupload', {
                    api_token: this.token,
                    image: file,
                })
                .then( res => {
                    return JSON.parse(res)
                })
                .then( img => {
                    that.preview_images.push(img)
                })
                .catch( err => {
                    console.log(err)
                })
            }
        },
        readFiles() {
            // console.log(this)
            // console.log(this.files)
            let files = this.$refs.uploads.files
            let that = this
            for(let file of files)
            {
                let container = document.createElement('div')
                container.classList.add('img-preview-container')
                fn.qs('#uploads__staging #upload-images').append(container)

                EXIF.getData(file, function() {
                    let orientation = this.exifdata.Orientation
                    let fr = new FileReader();

                    fr.onload = function() {
                        that.resetOrientation(this.result, orientation, appendImage, container)
                    }

                    fr.readAsDataURL(file);
                })
            }
        },
        // Taken from StackOverflow
        resetOrientation(srcBase64, srcOrientation, callback, container) {
            var img = new Image();

            img.onload = function() {
                var width = img.width,
                    height = img.height,
                    canvas = document.createElement('canvas'),
                    ctx = canvas.getContext("2d");

                // set proper canvas dimensions before transform & export
                if (4 < srcOrientation && srcOrientation < 9) {
                    canvas.width = height;
                    canvas.height = width;
                }
                else
                {
                    canvas.width = width;
                    canvas.height = height;
                }

                // transform context before drawing image
                switch (srcOrientation) {
                    case 2: ctx.transform(-1, 0, 0, 1, width, 0); break;
                    case 3: ctx.transform(-1, 0, 0, -1, width, height); break;
                    case 4: ctx.transform(1, 0, 0, -1, 0, height); break;
                    case 5: ctx.transform(0, 1, 1, 0, 0, 0); break;
                    case 6: ctx.transform(0, 1, -1, 0, height, 0); break;
                    case 7: ctx.transform(0, -1, -1, 0, height, width); break;
                    case 8: ctx.transform(0, -1, 1, 0, 0, width); break;
                    default: break;
                }

                // draw image
                ctx.drawImage(img, 0, 0);

                // export base64
                callback(canvas.toDataURL(), container);
            };

            img.src = srcBase64;
        },
    },
}
</script>
