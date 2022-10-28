<template>
    <div class="bg-modal fixed grid justify-center items-center">
        <div :id="'canvas-wrapper' + canvasID" class="relative">
            <button
                @click="closeModal"
                class="
                    z-20
                    bg-darkmodecolor-300
                    flex
                    justify-center
                    items-center
                    rounded-full
                    p-4
                    h-12
                    w-12
                    shadow-md
                    absolute
                    top-7
                    left-3
                "
            >
                <i class="fa fa-chevron-left fa-lg text-white"></i>
            </button>
            <Commentcard
                v-if="isCommenting"
                :mouseX="mouseX"
                :mouseY="mouseY"
                @drawComment="drawComment"
            ></Commentcard>
            <canvas :id="canvasID" class="canvas"></canvas>
            <div
                class="
                    flex
                    absolute
                    bottom-0
                    z-20
                    p-2
                    m-3
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
            annotations: {},
        };
    },
    mounted() {
        this.canvas = new fabric.Canvas(this.canvasID, {
            height: window.innerHeight,
            width: window.innerWidth,
            fireRightClick: true,
            stopContextMenu: true,
        });
        this.getImageMeta(this.illustration.url);
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
        initializeCanvasImage(img) {
            this.imgWidth = img.width;
            this.imgHeight = img.height;
            console.log(this.imgWidth, this.imgHeight);
            this.canvas.setBackgroundImage(
                this.illustration.url,
                this.canvas.renderAll.bind(this.canvas)
                // {
                //     scaleX: this.canvas.width / this.imgWidth,
                //     scaleY: this.canvas.height / this.imgHeight,
                // }
            );
            this.canvas.selection = true;

            this.canvas.on({
                "mouse:down": (options) => {
                    let coords = this.currentMouseCoords(options);
                    this.mouseX = coords.x;
                    this.mouseY = coords.y;
                    switch (options.button) {
                        case 3:
                            this.onRightClick(options);
                            break;
                        case 1:
                            this.onLeftClick(options);
                            break;
                    }

                    // Multi press controls
                    let event = options.e;
                    if (event.altKey === true) {
                        this.isDragging = true;
                        this.selection = false;
                        this.lastPosX = event.clientX;
                        this.lastPosY = event.clientY;
                    }
                    // 1 == left; 2 == middle; 3 == right
                    if (options.button == 3) this.onRightClick(options);
                    else if (options.button == 1) this.onLeftClick(options);
                },
                "mouse:move": function (opt) {
                    if (!this.isDragging) return;
                    var e = opt.e;
                    var vpt = this.viewportTransform;
                    vpt[4] += e.clientX - this.lastPosX;
                    vpt[5] += e.clientY - this.lastPosY;
                    this.requestRenderAll();
                    this.lastPosX = e.clientX;
                    this.lastPosY = e.clientY;
                },
                "mouse:up": function (opt) {
                    // on mouse up we want to recalculate new interaction
                    // for all objects, so we call setViewportTransform
                    this.setViewportTransform(this.viewportTransform);
                    this.isDragging = false;
                    this.selection = true;
                },
                "mouse:wheel": (opt) => {
                    var delta = opt.e.deltaY;
                    var zoom = this.canvas.getZoom();
                    zoom *= 0.999 ** delta;
                    if (zoom > 20) zoom = 20;
                    if (zoom < 0.01) zoom = 0.01;
                    this.canvas.zoomToPoint(
                        { x: opt.e.offsetX, y: opt.e.offsetY },
                        zoom
                    );
                    opt.e.preventDefault();
                    opt.e.stopPropagation();
                },
                "touch:longpress": (options) => {
                    console.log("longpress", options);
                },
            });
        },
        getImageMeta(url) {
            const img = new Image();
            img.onload = (res) => this.initializeCanvasImage(res.target);
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
            this.annotations = this.canvas.toJSON();
            const dataURL = this.canvas.toDataURL({
                width: this.imgWidth,
                height: this.imgHeight,
                left: 0,
                top: 0,
                format: "png",
            });
            this.$emit("closemodal", this.annotations, dataURL);
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