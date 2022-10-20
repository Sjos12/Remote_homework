<template>
    <div
        @click.self="closeModal"
        class="bg-modal fixed grid justify-center items-center"
    >
        <div :id="'canvas-wrapper' + canvasID" class="relative">
            <div
                v-if="isCommenting"
                :style="{ left: this.mouseX + 'px', top: this.mouseY + 'px' }"
                class="card p-2 w-48 h-32 absolute z-50"
            >
                <input v-model="commentText" type="text" class="form-control" />
                <button @click="drawComment">Done</button>
            </div>
            <canvas :id="canvasID" class="canvas"></canvas>
        </div>

        <div class="flex w-full bg-darkmodecolor-300">
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
            canvas: null,
            tools: new CanvasTools(),
            activeObject: "comments",
            isCommenting: false,
            commentText: "",
            mouseX: 0,
            mouseY: 0,
        };
    },
    mounted() {
        this.canvas = new fabric.Canvas(this.canvasID, {
            height: 800,
            width: 400,
            fireRightClick: true,
            stopContextMenu: true,
        });
        this.canvas.setBackgroundImage(
            "https://via.placeholder.com/300",
            this.canvas.renderAll.bind(this.canvas)
        );
        this.canvas.selection = true;

        this.canvas.on({
            "mouse:down": (options) => {
                // 1 == left; 2 == middle; 3 == right
                if (options.button !== 3) return;
                let coords = this.currentMouseCoords(options);
                this.mouseX = coords.x;
                this.mouseY = coords.y;

                this.chooseAction(options);
            },
            "touch:longpress": (options) => {
                console.log("longpress", options);
            },
        });
    },
    computed: {
        canvasID() {
            return "canvas" + this.id;
        },
    },
    methods: {
        chooseAction(event) {
            switch (this.activeObject) {
                case "comments":
                    this.openCommentDialog(event);
                    break;
                case "text":
                    break;
                case "drawing":
                    break;
            }
        },
        openCommentDialog() {
            this.isCommenting = true;
        },
        onMouseMove(group, option) {
            var textObj = group.item(1);
            console.log(option);
            if (option) {
                if (textObj.visible) return;
                textObj.set("visible", true);
            } else {
                console.log("text object gets hiddne");
                if (!textObj.visible) return;
                textObj.set("visible", false);
            }
            group.dirty = true;
            this.canvas.requestRenderAll();
        },
        drawComment(event) {
            this.isCommenting = false;
            let handle = new fabric.Circle({
                radius: 10,
                fill: "blue",
                originX: "center",
                originY: "center",
                padding: 10,
            });
            let comment = new fabric.Textbox(this.commentText, {
                visible: false,
                width: 100,
                backgroundColor: "#252525",
                stroke: "white",
                fontFamily: "Roboto",
                fontSize: 12,
                padding: 20,

                absolutePositioned: true,
                left: this.getCommentPosition(handle),
            });
            console.log(comment.left);

            let group = new fabric.Group([handle, comment], {
                left: this.mouseX,
                top: this.mouseY,
                subTargetCheck: true,
                hasControls: false,
                hasBorders: false,
                selection: false,
            });
            group.item(0).on("mousedown", (option) => {
                console.log("mousedown");
                this.onMouseMove(group, option);
                // this.canvas.on("mouse:move");
            });
            group.item(0).on("mouseup", (option) => {
                console.log("mouseup");
                // this.canvas.off("mouse:move", this.onMouseMove(group, option));
                this.onMouseMove(group);
            });

            this.canvas.add(group);

            this.commentText = "";
        },
        getCommentPosition(handleObject) {
            let coords = handleObject.getCoords();
            let commentWidth = 100;
            if (coords.x + commentWidth < this.canvas.width) {
                return 0;
            } else {
                return -commentWidth;
            }
        },
        currentMouseCoords(options) {
            var pointer = this.canvas.getPointer(options.e);
            var posX = pointer.x;
            var posY = pointer.y;
            return { x: posX, y: posY };
        },
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