<template>
    <div class="">
        <img
            ref="tile"
            class="imagetile relative z-50"
            @click="editImage"
            :src="illustration.url"
            alt="Edited image"
        />

        <AnnotationModal
            :style="{
                left: left + 'px',
                right: right + 'px',
                top: top + 'px',
                bottom: bottom + 'px',
            }"
            @closemodal="isBeingEdited = false"
            :class="isBeingEdited ? 'active' : 'closed'"
            class="duration-100 transition-all ease-in-out"
            :illustration="illustration"
        ></AnnotationModal>
    </div>
</template>
<script>
import AnnotationModal from "../components/AnnotationModal.vue";
export default {
    props: ["illustration"],
    components: {
        AnnotationModal,
    },
    emits: ["editImage"],
    data() {
        return {
            isBeingEdited: false,
            left: 0,
            right: 0,
            top: 0,
            bottom: 0,
        };
    },
    mounted() {
        this.left = this.$refs.tile.getBoundingClientRect().left;
        this.right = this.$refs.tile.getBoundingClientRect().right;
        this.top = this.$refs.tile.getBoundingClientRect().top;
        this.bottom = this.$refs.tile.getBoundingClientRect().bottom;
    },
    methods: {
        editImage() {
            this.isBeingEdited = true;
        },
    },
    computed: {},
};
</script>
<style lang="scss" scoped>
.closed {
    width: 100px;
    visibility: hidden;
    height: 100px;
    z-index: 0;
}
.active {
    visibility: visible;
    top: 0px !important;
    left: 0px !important;
    right: 0px !important;
    bottom: 0px !important;
    height: 100vh;
    z-index: 100;
    width: 100vw;
    height: 100vh;
}
</style>