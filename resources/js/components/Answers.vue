<template>
    <div class="flex justify-between items-center">
        <label class="text-mainblue">{{ count }} answers</label>
        <button @click.prevent="loadAnswers" class="btn bg-blue-300">
            See answers
        </button>
    </div>

    <div v-if="this.displayAnswer" class="grid gap-y-10">
        <Link
            :href="
                $route('questions.answer.show', {
                    question: question.uuid,
                    answer: answer.uuid,
                })
            "
            v-for="answer of answers"
            :key="answer.id"
            class="card"
            >{{ answer.author.name }}

            <label>{{ getAnswerDate(answer) }}</label></Link
        >
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import { DateTime } from "luxon";
export default {
    props: ["answers", "question", "count"],
    components: {
        Link,
    },
    data() {
        return {
            displayAnswer: false,
        };
    },
    computed: {},
    methods: {
        getAnswerDate(answer) {
            console.log(answer);
            return DateTime.fromISO(answer.created_at).toRelative();
        },
        loadAnswers() {
            this.displayAnswer = !this.displayAnswer;
        },
    },
};
</script>