<template>
    <Link :href="$route('questions.answer', question.uuid)" class="card">
        <h1 class="question__title">{{ question.title }}</h1>
        <CarouselThumbnail :illustrations="question.illustrations" />
        <Answers
            :question="question"
            :count="this.question.answers_count"
            :answers="question.answers"
        />
    </Link>
</template>
<script>
import CarouselThumbnail from "./CarouselThumbnail.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Answers from "./Answers.vue";
export default {
    props: ["question"],
    components: { CarouselThumbnail, Link, Answers },
    data() {
        console.log(this.question);
        return {};
    },
};
</script>