<template>
    <div class="card">
        <h1 class="title">Creating a group</h1>
        <div class="form">
            <div class="form__row">
                <label for="name">Name this group</label>
                <input
                    type="text"
                    id="name"
                    v-model="groupForm.name"
                    class="form-control input--shadow"
                />
            </div>
            <div class="form__row">
                <label for="subject">Subject name</label>
                <input
                    type="text"
                    id="subject"
                    v-model="groupForm.subject"
                    class="form-control input--shadow"
                />
            </div>
            <div class="form__row">
                <label for="name">Description name</label>
                <textarea
                    id="description"
                    v-model="groupForm.description"
                    class="form-control input input--shadow"
                ></textarea>
            </div>
            <div class="form__row">
                <button @click="submit" type="button" class="btn-primary btn">
                    Submit
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";
import LayoutVue from "../Layouts/Layout.vue";
export default {
    layout: LayoutVue,
    data() {
        return {
            groupForm: useForm({
                name: null,
                description: null,
                subject: null,
            }),
        };
    },
    methods: {
        submit() {
            let url = route("group.create");
            this.groupForm.post(url, {});
        },
    },
};
</script>