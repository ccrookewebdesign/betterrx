<template>
    <div class="text-white block md:flex md:space-x-12 mt-8">
        <div class="w-full md:w-1/2">
            <h2 class="text-xl sm:text-3xl font-bold mb-4">BetterRX Image Uploader</h2>

            <form @submit.prevent="uploadImage" method="post" enctype="multipart/form-data">
                <div class="flex-col flex">
                    <div class="text-sm text-blue-800 rounded p-2 border-2 border-green-300 mb-4 bg-white" v-if="successMessage">{{ successMessage }}</div>
                    <div class="text-sm text-red-800 rounded border-2 border-red-600 p-2 mb-4 bg-gray-200" v-if="errorMessage">{{ errorMessage }}</div>

                    <label for="imageUploader" class="text-sm">Select an image*</label>
                    <input id="imageUploader"
                           type="file"
                           name="image"
                           @change="imageSelected"
                           @click="successMessage = null"
                           accept="image/x-png"
                           class="w-full md:w-5/6 focus:outline-none rounded my-1 bg-betterrx-lighter p-4">

                    <button type="submit"
                            :disabled="btnDisabled"
                            :class="{'opacity-50': btnDisabled, 'cursor-default': btnDisabled}"
                            class="rounded bg-white text-betterrx-orange w-48 mt-2 p-3 font-bold text-xl lg:hover:shadow-lg focus:outline-none">Submit
                    </button>

                    <div v-if="previewImage" class="mt-6">
                        <div class="text-sm my-1">Selected image</div>
                        <img :src="previewImage" class="w-full sm:w-2/5 hover:shadow-2xl hover:opacity-75 mb-8">
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full md:w-1/2  rounded border border-white p-8 pt-4 mt-2" v-if="uploadedImages.length">
            <div class="text-sm md:text-xl font-bold mb-4 text-center">Previously uploaded images</div>
            <uploaded-image v-for="(uploadedImage, index) in uploadedImages" :key="index" :image="uploadedImage" /><br>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import UploadedImage from "./uploadedImage";

export default {
    components: {UploadedImage},
    props: {},
    data(){
        return {
            image: null,
            previewImage: null,
            errorMessage: null,
            successMessage: null,
            uploadedImages: [],
        }
    },
    computed: {
        btnDisabled(){
            return (!this.image || this.errorMessage);
        }
    },
    methods: {
        imageSelected(e){
            this.image = e.target.files[0];
            this.errorMessage = null;

            if(this.image.type !== 'image/png'){
                this.errorMessage = "The image type must be PNG.";
                return false;
            }

            let reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = e => {
                this.previewImage = e.target.result;
            };
        },

        uploadImage(){
            let data = new FormData;
            data.append('image', this.image);

            axios.post('/upload-image', data)
                .then((resp) => {
                    this.uploadedImages = resp.data.uploadedImages;

                    if(resp.data.status === 'success'){
                        this.successMessage = resp.data.message;
                    }else{
                        this.errorMessage = resp.data.message;
                    }

                    // console.log('uploadedImages', this.successMessage, this.uploadedImages);
                }).catch((e) => {
                console.log('e', e);
            });
        }
    },
    created(){
        axios.get('/uploaded-images')
            .then((resp) => {
                this.uploadedImages = resp.data.uploadedImages === null ? [] : resp.data.uploadedImages;
                // console.log('uploadedImages', this.successMessage, this.uploadedImages);
            }).catch((e) => {
            console.log('e', e);
        });
    }
}
</script>
