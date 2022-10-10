<template>
    <div class="">
        <h1 class="text-6xl">Answer the question</h1>

        <input type="textarea" />
        <div class="mx-auto grid grid-cols-4 gap-4 gap-y-4">
            <ImageThumbnail
                @edit-image="editImage"
                v-for="n in 10"
                :key="n"
            ></ImageThumbnail>
            <button
                @click="addBlankPage"
                class="imagetile bg-gray-400 p-4 text-white"
            >
                Add Page
                <i class="fa fa-plus fa-lg"></i>
            </button>
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
    components: { AnnotationModalVue, ImageThumbnail },
    layout: LayoutVue,
    data() {
        return {};
    },
    methods: {
        addBlankPage() {},
    },
};
</script>

<style lang="scss" scoped>
</style>