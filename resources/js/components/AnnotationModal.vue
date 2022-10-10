<template>
    <div class="bg-modal absolute flex justify-center items-center">
        <canvas id="canvas"> </canvas>

        <div class="toolbar">
            <button>Comments</button>
            <button>Text</button>
            <button>Free draw</button>
        </div>
    </div>
</template>
<script>
import { CanvasTools } from "../tools";
export default {
    props: {
        tile: Object,
    },
    data() {
        return {
            tools: new CanvasTools(),
            activeObject: "comments",
        };
    },
    setup(props) {
        console.log(props);
    },
    mounted() {},
    methods: {
        onImageClick(event) {
            console.log(event.target);
        },
    },
};
</script>
<style lang="scss" scoped>
</style>