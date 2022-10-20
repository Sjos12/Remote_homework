<template>
    <div class="container card vh-150">
        <form enctype="multipart/form-data" id="myDropzone">
            <div class="">
                <div class="row">
                    <div class="form-group col-12 col-md-8 offset-md-2">
                        <label for="title">Question Title</label>
                        <input
                            v-model="questionForm.title"
                            type="text"
                            class="title6 form-control"
                            id="title"
                            name="title"
                            aria-describedby="titleHelp"
                        />
                    </div>

                    <div class="form-group col-12 col-md-8 offset-md-2">
                        <label for="content"> Your Question </label>
                        <textarea
                            id="content"
                            class="form-control contentarea"
                            rows="5"
                            name="content"
                            aria-describedby="contentHelp"
                            v-model="questionForm.content"
                        ></textarea>
                        <small id="contentHelp" class="form-text text-muted">
                            Describe in as much detail as possible exactly the
                            question you have
                        </small>
                    </div>

                    <div>
                        <input
                            type="file"
                            @input="
                                questionForm.illustrations = $event.target.files
                            "
                        />
                    </div>

                    <div>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="submit"
                        >
                            Submit
                        </button>
                    </div>
                    {{ questionForm }}
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import LayoutVue from "../Layouts/Layout.vue";
import { useDropzone } from "vue3-dropzone";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    layout: LayoutVue,
    props: ["categories", "group"],
    data() {
        return {
            questionForm: useForm({
                title: null,
                content: null,
                categories: [],
                illustrations: [],
            }),
        };
    },
    methods: {
        submit() {
            let url = route("questions.create", this.group.id);
            this.questionForm.post(url);
        },
    },
};
</script>