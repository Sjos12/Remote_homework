<template>
    <div class="grid gap-y-5">
        <div class="card flex flex-col gap-y-4 justify-between">
            <div class=""><span class="card__pill"> Dashboard </span></div>

            <h1 class="title">Answering a question</h1>
        </div>
        <div class="card">
            <textarea></textarea>
            <div class="mx-auto grid grid-cols-2 gap-4 gap-y-4">
                <ImageThumbnail
                    @edit-image="editImage"
                    v-for="illustration of question.illustrations"
                    :key="illustration.id"
                    :illustration="illustration"
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
    props: ["question"],
    data() {
        console.log(this.question);
        return {
            annotations: [],
        };
    },
    
    methods: {
        addBlankPage() {
            this.annotations.push()
        },
        editImage() {},
    },
};
</script>

<style lang="scss" scoped>
</style>