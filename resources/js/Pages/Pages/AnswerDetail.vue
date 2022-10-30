<template>
    <div class="card flex flex-col gap-y-4 justify-between">
        <div class=""><span class="card__pill"> Question Answer </span></div>

        <h1 class="title">{{ question.title }}</h1>
    </div>
    <div class="card">
        <p>
            {{ answer.content }}
        </p>
        <canvas id="answer" class="w-full h-full"></canvas>
    </div>
</template>
<script>
import Layout from "../Layouts/Layout.vue";
export default {
    layout: Layout,
    props: ["answer", "question"],
    data() {
        return {
            canvas: null,
        };
    },
    mounted() {
        this.canvas = new fabric.Canvas("answer");
        console.log(this.answer.annotations);
        this.canvas.loadFromJSON(this.answer.annotations[0].annotation);
    },
};
</script>