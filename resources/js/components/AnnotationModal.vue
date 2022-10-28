<template>
    <div
        @click.self="closeModal"
        class="bg-modal fixed grid justify-center items-center"
    >
        <div :id="'canvas-wrapper' + canvasID" class="relative">
            <Commentcard
                v-if="isCommenting"
                :mouseX="mouseX"
                :mouseY="mouseY"
                @drawComment="drawComment"
            ></Commentcard>
            <canvas :id="canvasID" class="canvas"></canvas>
        </div>

        <div
            class="
                flex
                p-2
                justify-between
                rounded-md
                w-full
                bg-darkmodecolor-300
            "
        >
            <button>Text</button>
            <button
                :class="markerSelected && 'active'"
                @click="activeTool = 'comments'"
            >
                Comment
            </button>
            <button
                :class="markerSelected && 'active'"
                @click="activeTool = 'marker'"
            >
                Marker
            </button>
        </div>
    </div>
</template>
<script>
import { CanvasTools } from "../tools";
import Commentcard from "./Commentcard.vue";
export default {
    components: {
        Commentcard,
    },
    emits: ["closemodal"],
    props: ["illustration"],
    data() {
        return {
            canvas: null,
            tools: new CanvasTools(),
            activeTool: "comments",
            isCommenting: false,
            mouseX: 0,
            mouseY: 0,
            imgWidth: 0,
            imgHeight: 0,
        };
    },
    mounted() {
        let img = this.getMeta(this.illustration.url);
        this.canvas = new fabric.Canvas(this.canvasID, {
            height: 800,
            width: 400,
            fireRightClick: true,
            stopContextMenu: true,
        });
        console.log(this.imgWidth);
        this.canvas.setBackgroundImage(
            this.illustration.url,
            this.canvas.renderAll.bind(this.canvas),
            {
                scaleX: this.canvas.width / this.imgWidth,
                scaleY: this.canvas.height / this.imgHeight,
            }
        );
        this.canvas.selection = true;

        this.canvas.on({
            "mouse:down": (options) => {
                let coords = this.currentMouseCoords(options);
                this.mouseX = coords.x;
                this.mouseY = coords.y;
                // 1 == left; 2 == middle; 3 == right
                if (options.button == 3) this.onRightClick(options);
                else if (options.button == 1) this.onLeftClick(options);
            },
            "touch:longpress": (options) => {
                console.log("longpress", options);
            },
        });
    },
    computed: {
        canvasID() {
            return "canvas" + this.illustration.uuid;
        },
        markerSelected() {
            if ((this.activeTool = "marker")) return true;
            return false;
        },
    },
    methods: {
        getMeta(url) {
            const img = new Image();
            let self = this;
            img.addEventListener("load", function () {
                self.imgWidth = this.naturalWidth;
                self.imgHeight = this.naturalHeight;
            });
            img.src = url;
        },
        onLeftClick(options) {
            console.log("left click", this.activeTool);
            switch (this.activeTool) {
                case "text":
                    break;
                case "drawing":
                    break;
                case "marker":
                    this.selectMarker(event);
                    break;
            }
        },
        onRightClick(options) {
            console.log("right click");
            if (this.canvas.isDrawingMode && this.activeTool !== "comment")
                return;

            this.openCommentDialog(options);
            switch (this.activeTool) {
                case "comments":
                    break;
            }
        },

        selectMarker(event) {
            this.canvas.set("isDrawingMode", true);
            this.canvas.freeDrawingBrush.width = 5;
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
        drawComment(text) {
            this.isCommenting = false;
            let handle = new fabric.Circle({
                radius: 10,
                fill: "blue",
                originX: "center",
                originY: "center",
                padding: 10,
            });
            let comment = new fabric.Textbox(text, {
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