<template>
    <div class="card flex flex-col gap-y-4 justify-between">
        <div class=""><span class="card__pill"> Question feed </span></div>

        <h1 class="title">Welcome, {{ user.name }}</h1>
    </div>

    <div class="card flex flex-col gap-y-3">
        <div class="flex justify-between">
            <h2>Your groups</h2>
            <Link
                class="text-mainblue my-auto"
                :href="$route('group.create.index')"
                >Create group</Link
            >
        </div>

        <div class="flex">
            <Link
                v-for="group of groups"
                :key="group.id"
                :href="$route('group.detail', group)"
            >
                <span
                    class="rounded-full my-4 shadow-md p-3 bg-darkmodecolor-200"
                    >{{ group.name }}</span
                >
            </Link>
        </div>

        <div class="flex">
            <input
                placeholder="Enter an invite code..."
                type="text"
                v-model="joinGroupForm.groupCode"
            />
            <button class="btn" @click="submitJoinGroupForm">Join</button>
        </div>
    </div>
    <div class="grid gap-y-5">
        <Question
            v-for="question of questions"
            :key="question.id"
            :question="question"
        />
    </div>
</template>
<script>
import LayoutVue from "../Layouts/Layout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import CarouselThumbnail from "../../components/CarouselThumbnail.vue";
import Question from "../../components/Question.vue";
export default {
    props: ["groups", "user", "questions"],
    components: {
        Link,
        Question,
        CarouselThumbnail,
    },
    layout: LayoutVue,
    setup(props) {
        console.log(props);
    },
    data() {
        return {
            joinGroupForm: useForm({
                groupCode: "",
            }),
        };
    },
    methods: {
        submitJoinGroupForm() {
            let url = route("group.join");
            this.joinGroupForm.post(url);
        },
    },
};
</script>