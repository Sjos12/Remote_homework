<template>
    <div class="bg-modal fixed grid justify-center items-center">
        <div
            @click="getCursorPosition($event)"
            :id="'canvas-wrapper' + canvasID"
            class="relative"
        >
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
                :mouseX="absoluteX"
                :mouseY="absoluteY"
                @drawComment="drawComment"
            ></Commentcard>
            <canvas ref="canvas" :id="canvasID" class="canvas"></canvas>
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
                    left-0
                    right-0
                    bg-darkmodecolor-300
                "
            >
                <!-- <button
                :class="activeTool == 'text' ? 'active' : 'inactive'"
                @click="activeTool = 'text'"
            >
                Text
            </button> -->
                <button
                    :class="activeTool == 'comments' ? 'active' : 'inactive'"
                    @click="switchToTool('comments')"
                >
                    Comments
                </button>
                <button
                    :class="activeTool == 'marker' ? 'active' : 'inactive'"
                    @click="switchToTool('marker')"
                >
                    Marker
                </button>
                <button
                    :class="activeTool == 'trash' ? 'active' : 'inactive'"
                    @click="deleteSelectedObject()"
                >
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script >
import { defineComponent } from "vue";
import { CanvasTools } from "../tools";
import Commentcard from "./Commentcard.vue";
import { fabric } from "fabric";
export default defineComponent({
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
            toolKeys: ["comments", "marker", "rectangle", "trash"],
            isCommenting: false,
            mouseX: 0,
            mouseY: 0,
            absoluteX: 0,
            absoluteY: 0,
            imgWidth: 0,
            imgHeight: 0,
            annotations: {},
            lastPosY: 0,
            lastPosX: 0,
            isDragging: false,
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
        getZoom() {
            return this.canvas.getZoom();
        },
        isOutsideOfCanvas() {
            if (this.mouseX < 0 || this.mouseY < 0) {
                return true;
            }
            return false;
        },
    },
    methods: {
        getCursorPosition(object) {
            console.log("call");
            this.absoluteX =
                (this.canvas.getPointer().x + this.canvas._offset.left) *
                this.canvas.zoom;
            this.absoluteY =
                (this.canvas.getPointer().y + this.canvas._offset.top) *
                this.canvas.zoom;
            console.log(this.absoluteX, this.absoluteY);
        },
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
                    // this.setAbsolutePosition(options);
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
                "mouse:move": (opt) => {
                    if (!this.isDragging) return;
                    var e = opt.e;
                    var vpt = this.canvas.viewportTransform;

                    vpt[4] += e.clientX - this.lastPosX;
                    vpt[5] += e.clientY - this.lastPosY;
                    this.canvas.requestRenderAll();
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
                    this.getCursorPosition(opt.e);
                    opt.e.preventDefault();
                    opt.e.stopPropagation();
                },
                "touch:longpress": (options) => {
                    console.log("longpress", options);
                },
            });
        },

        onLeftClick(options) {
            switch (this.activeTool) {
                case "text":
                    break;
                case "drawing":
                    break;
                case "marker":
                    this.selectMarker(event);
                    break;
                case "comments":
                    this.openCommentDialog(options);
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
        switchToTool(tool) {
            this.activeTool = tool;
            this.deselectTools();
        },
        deselectTools() {
            this.toolKeys.forEach((key) => {
                if (key === this.activeTool) return;

                switch (key) {
                    case "text":
                        break;
                    case "drawing":
                        break;
                    case "comments":
                        this.deselectComments();
                        break;
                    case "marker":
                        this.deselectMarker();
                        break;
                }
            });
        },
        selectMarker(event) {
            console.log("select");
            this.canvas.set("isDrawingMode", true);
            this.canvas.freeDrawingBrush.width = 5;
        },
        deselectMarker() {
            this.canvas.set("isDrawingMode", false);
        },

        getImageMeta(url) {
            const img = new Image();
            img.onload = (res) => this.initializeCanvasImage(res.target);
            img.src = url;
        },
        openCommentDialog(option) {
            this.isCommenting = true;

            let temp = new fabric.Circle({
                left: this.canvas.getPointer(option).x,
                top: this.canvas.getPointer(option).y,
                color: "blue",
                radius: 4,
                originX: "center",
                originY: "center",
            });

            this.canvas.add(temp);
            this.getCursorPosition(temp);
        },
        deselectComments() {
            this.isCommenting = false;
        },
        onMouseMove(group, option) {
            var textObj = group.item(1);
            console.log(option);
            if (group.displayComment) {
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

            let radius = 8;

            let [r, g, b, a] = this.getAverageColorFromRectangle(
                this.mouseX - radius / 2,
                this.mouseY - radius / 2,
                radius,
                radius
            );
            console.log(this.mouseX, this.mouseY, r, g, b, a);
            let color = this.getContrastingColor(r, g, b);

            let handle = new fabric.Circle({
                radius: radius,
                fill: color,
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
                fontWeight: 200,
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
            group.displayComment = false;
            group.item(0).on("mousedown", (option) => {
                group.displayComment = !group.displayComment;
                this.onMouseMove(group, option);
            });
            // group.item(0).on("mouseup", (option) => {
            //     console.log("mouseup");
            //     // this.canvas.off("mouse:move", this.onMouseMove(group, option));
            //     this.onMouseMove(group);
            // });

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
            var posX = pointer.x * this.canvas.getZoom();
            var posY = pointer.y * this.canvas.getZoom();
            console.log(posX, posY);
            return { x: posX, y: posY };
        },
        closeModal() {
            // Reset viewport
            this.resetCanvasViewport();
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
        resetCanvasViewport() {
            this.canvas.setViewportTransform([1, 0, 0, 1, 0, 0]);
        },
        deleteSelectedObject() {
            this.canvas.remove(this.canvas.getActiveObject());
        },
        getAverageColorFromRectangle(sx, sy, sw, sh) {
            let ctx = this.$refs.canvas.getContext("2d");

            let R = 0;
            let G = 0;
            let B = 0;
            let A = 0;
            let wR = 0;
            let wG = 0;
            let wB = 0;
            let wTotal = 0;

            let data = ctx.getImageData(sx, sy, sw, sh).data;
            const components = data.length;

            for (let i = 0; i < components; i += 4) {
                // A single pixel (R, G, B, A) will take 4 positions in the array:
                const r = data[i];
                const g = data[i + 1];
                const b = data[i + 2];
                const a = data[i + 3];

                // Update components for solid color and alpha averages:
                R += r;
                G += g;
                B += b;
                A += a;

                // Update components for alpha-weighted average:
                const w = a / 255;
                wR += r * w;
                wG += g * w;
                wB += b * w;
                wTotal += w;
            }

            const pixelsPerChannel = components / 4;

            // The | operator is used here to perform an integer division:

            R = (R / pixelsPerChannel) | 0;
            G = (G / pixelsPerChannel) | 0;
            B = (B / pixelsPerChannel) | 0;
            wR = (wR / wTotal) | 0;
            wG = (wG / wTotal) | 0;
            wB = (wB / wTotal) | 0;

            // The alpha channel need to be in the [0, 1] range:

            A = A / pixelsPerChannel / 255;
            return [R, G, B, A];
        },
        getContrastingColor(r, g, b) {
            let colors = { light: "#757474", dark: "#0A0A0A" };

            let hsp = Math.sqrt(
                0.299 * (r * r) + 0.587 * (g * g) + 0.114 * (b * b)
            );
            console.log("hsp" + hsp);
            // Using the HSP value, determine whether the color is light or dark
            if (hsp > 127.5) {
                console.log("dark");
                return colors.light;
            } else {
                console.log("light");
                return colors.dark;
            }
        },
    },
});
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

.active {
    @apply bg-mainblue rounded-sm p-2 duration-200 ease-in-out;
}
.inactive {
    @apply bg-darkmodecolor-200 rounded-sm p-2 duration-200 ease-in-out;
}
</style>