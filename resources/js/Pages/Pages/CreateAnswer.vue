<template>
    <div class="grid gap-y-5">
        <div class="card flex flex-col gap-y-4 justify-between">
            <div class=""><span class="card__pill"> Dashboard </span></div>

            <h1 class="title">Answering a question</h1>
        </div>
        <div class="card">
            <QuestionVue v-if="showQuestion" :question="question" />
            <button @click="toggleQuestion">See original question</button>
        </div>
        <div class="card">
            <textarea v-model="answerForm.content"></textarea>
            <div class="mx-auto grid grid-cols-2 gap-4 gap-y-4">
                <ImageThumbnail
                    @edit-image="editImage"
                    @annotations="
                        (annotations) =>
                            saveAnnotations(annotations, illustration)
                    "
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

            <div class="flex">
                <button type="button" @click="submitAnswer" class="btn">
                    Submit
                </button>
            </div>
        </div>
    </div>
</template>

<script >
import AnnotationModalVue from "../../components/AnnotationModal.vue";
import LayoutVue from "../Layouts/Layout.vue";
import AnnotationModal from "../../components/AnnotationModal.vue";
import ImageThumbnailVue from "../../components/ImageThumbnail.vue";
import ImageThumbnail from "../../components/ImageThumbnail.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import QuestionVue from "../../components/Question.vue";
export default {
    components: { AnnotationModalVue, ImageThumbnail, QuestionVue },
    layout: LayoutVue,
    props: ["question"],
    data() {
        console.log(this.question);
        return {
            answerForm: useForm({
                content: "",
                annotations: [],
            }),
            showQuestion: false,
        };
    },

    methods: {
        toggleQuestion() {
            this.showQuestion = !this.showQuestion;
        },
        saveAnnotations(annotations, illustration) {
            this.answerForm.annotations = [
                ...this.answerForm.annotations,
                {
                    illustration_id: illustration.id,
                    annotation: annotations,
                },
            ];
        },
        submitAnswer() {
            console.log(this.answerForm);
            let url = route("questions.answered", this.question.uuid);
            this.answerForm.post(url);
        },
        addBlankPage() {
            this.answerForm.annotations.push({
                illustration_id: null,
                annotation: "",
            });
        },
        editImage() {},
    },
};
</script>

<style lang="scss" scoped>
</style>