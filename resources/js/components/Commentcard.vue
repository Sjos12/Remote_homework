<template>
    <div
        :style="{ left: this.mouseX + 'px', top: this.mouseY + 'px' }"
        class="card p-2 w-48 absolute z-50"
    >
        <textarea
            v-model="commentText"
            type="text"
            class="form-control text-sm"
        ></textarea>
        <button class="btn w-full" @click="drawComment">Done</button>
    </div>
</template>
<script>
export default {
    props: ["mouseX", "mouseY"],
    emits: ["drawComment"],
    data() {
        return {
            commentText: "",
        };
    },
    methods: {
        drawComment() {
            this.$emit("drawComment", this.commentText);
        },
    },
};
</script>