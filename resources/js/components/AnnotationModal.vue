<template>
    <div
        @click.self="closeModal"
        class="bg-modal fixed flex justify-center items-center"
    >
        <canvas :id="canvasID" class="canvas"></canvas>

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
    emits: ["closemodal"],
    props: ["id"],
    data() {
        return {
            tools: new CanvasTools(),
            activeObject: "comments",
        };
    },
    mounted() {
        var canvas = new fabric.Canvas(this.canvasID);
        canvas.setHeight(800);
        canvas.setWidth(400);
        canvas.setBackgroundImage(
            "https://via.placeholder.com/300",
            canvas.renderAll.bind(canvas)
        );
        canvas.selection = true;
        var rect = new fabric.Rect();

        canvas.add(rect); // add object

        canvas.item(0); // reference fabric.Rect added earlier (first object)
        canvas.getObjects(); // get all objects on canvas (rect will be first and only)

        canvas.remove(rect);

        console.log(canvas); // remove previously-added fabric.Rect
    },
    computed: {
        canvasID() {
            return "canvas" + this.id;
        },
    },
    methods: {
        closeModal() {
            this.$emit("closemodal");
        },
        onImageClick(event) {
            console.log(event.target);
        },
    },
};
</script>
<style lang="scss" scoped>
.toolbar {
    display: grid;
}
.canvas {
    height: 800px;
    width: 400px;
    background: white;
}
</style>