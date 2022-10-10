<template>
    <div class="">
        <h1 class="text-6xl">Foo</h1>
        <div class="mx-auto grid grid-cols-3 gap-4 gap-y-4">
            <ImageThumbnail
                @edit-image="editImage"
                v-for="n in 10"
                :key="n"
            ></ImageThumbnail>
        </div>
    </div>
</template>

<script>
import AnnotationModalVue from "../../components/AnnotationModal.vue";
import LayoutVue from "../Layouts/Layout.vue";
import AnnotationModal from "../../components/AnnotationModal.vue";
import ImageThumbnailVue from "../../components/ImageThumbnail.vue";
import ImageThumbnail from "../../components/ImageThumbnail.vue";

export default {
    components: [AnnotationModalVue, ImageThumbnailVue],
    layout: LayoutVue,
    data() {
        return {
            modalIsOpen: false,
        };
    },
    methods: {
        editImage(imageKey) {
            this.modalIsOpen = true;
        },
    },
    components: { AnnotationModal, ImageThumbnail },
};
</script>

<style lang="scss" scoped>
</style>