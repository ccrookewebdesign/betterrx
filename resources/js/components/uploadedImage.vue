<template>
    <div>
        <img :src="image" @click="loadModal" class="cursor-pointer w-full rounded sm:w-4/5 mx-auto my-6 md:my-0 hover:shadow-lg" id="modalImage">
    </div>
</template>

<script>
export default {
    props: ['image'],
    data(){
        return {}
    },
    mounted(){},
    computed: {},
    methods: {
        loadModal(){
            this.$emit('loadmodal', this.image);
        }
    },
    created(){}
}
</script>
