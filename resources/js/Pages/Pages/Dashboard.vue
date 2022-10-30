<template>
    <div class="card flex flex-col gap-y-4 justify-between">
        <div class=""><span class="card__pill"> Question feed </span></div>

        <h1 class="title">Welcome, {{ user.name }}</h1>
        <div class="flex">
            <Link
                class="btn btn-primary my-auto"
                :href="$route('group.create.index')"
                >Create group</Link
            >
        </div>
    </div>

    <div class="card flex flex-col">
        <h2>Your groups</h2>
        <div class="flex">
            <Link
                v-for="group of groups"
                :key="group.id"
                :href="$route('group.detail', group)"
            >
                <span
                    class="
                        h-10
                        w-10
                        rounded-full
                        shadow-md
                        bg-darkmodecolor-100
                    "
                    >{{ group.name }}</span
                >
            </Link>
        </div>
        <Link class="btn" :href="$route('group.join.index')"> Join Group </Link>
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
import { Link } from "@inertiajs/inertia-vue3";
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
        return {};
    },
};
</script>