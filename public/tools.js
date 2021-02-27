let coll = document.getElementsByClassName("collapsible");
let i;
var lineMode = true;
var isDown;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    let title = document.getElementById("questiontitle");
    let content = document.getElementById("fulloriginalquestion");
    if (content.style.display === "block") {
      content.style.display = "none";
      title.style.display = "block";
      title.style.margin = "";
    } else {
      content.style.display = "block";
      title.style.margin = "0";
    }
  });
}

// reference canvas element (with id="c")
// create a wrapper around native canvas element (with id="c")
let canvasEl = document.getElementById('canvas')

if (canvasEl) {
    const canvas = new fabric.Canvas('canvas')
    canvasEl.fabric = canvas;

    // variable which chooses color of objects
    const objcolor = 'white';

    // Canvas zooming.
    canvas.on('mouse:wheel', function(opt) {
        var delta = opt.e.deltaY;
        var zoom = canvas.getZoom();
        zoom *= 0.999 ** delta;
        if (zoom > 20) zoom = 20;
        if (zoom < 0.01) zoom = 0.01;
        canvas.setZoom(zoom);
        opt.e.preventDefault();
        opt.e.stopPropagation();
    })

    canvas.on('mouse:down', function(opt) {
        var evt = opt.e;
        if (evt.altKey === true) {
            this.isDragging = true;
            this.selection = false;
            this.lastPosX = evt.clientX;
            this.lastPosY = evt.clientY;
        }
    });
    canvas.on('mouse:move', function(opt) {
        if (this.isDragging) {
            var e = opt.e;
            var vpt = this.viewportTransform;
            vpt[4] += e.clientX - this.lastPosX;
            vpt[5] += e.clientY - this.lastPosY;
            this.requestRenderAll();
            this.lastPosX = e.clientX;
            this.lastPosY = e.clientY;
        }
    });
    canvas.on('mouse:up', function(opt) {
        // on mouse up we want to recalculate new interaction
        // for all objects, so we call setViewportTransform
        this.setViewportTransform(this.viewportTransform);
        this.isDragging = false;
        this.selection = true;
    });

    canvas.on('mouse:wheel', function(opt) {
        var delta = opt.e.deltaY;
        var zoom = canvas.getZoom();
        zoom *= 0.999 ** delta;
        if (zoom > 20) zoom = 20;
        if (zoom < 0.01) zoom = 0.01;
        canvas.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
        opt.e.preventDefault();
        opt.e.stopPropagation();
    });


    function drawLine() {
        if (lineMode) {
            canvas.on('mouse:down', function (o) {
                if (lineMode) {
                    canvas.selection = false;
                    isDown = true;
                    var pointer = canvas.getPointer(o.e);
                    var points = [pointer.x, pointer.y, pointer.x, pointer.y];
        
                    line = new fabric.Line(points, {
                        strokeWidth: 3,
                        stroke: objcolor
                    });
                    canvas.add(line);
                }  
            });
    
    
            canvas.on('mouse:move', function (o) {
                if (lineMode && isDown) {
                    var pointer = canvas.getPointer(o.e);
                    line.set({ x2: pointer.x, y2: pointer.y });
                    canvas.renderAll();
                }
            });
    
            canvas.on('mouse:up', function (o) {
                canvas.selection = true;
                lineMode = false;
                isDown = false; 
                line.setCoords();
            });
            
        }
       else { 
           lineMode = true;
        }
        
    }

    //resets all zoom and panning -
    function resetZoom() {
        canvas.setViewportTransform([1,0,0,1,0,0]);
    }

    function freeDrawing() {
        let drawBtn = document.getElementById("drawBtn");
        console.log(drawBtn);
        if (canvas.lineModeMode) {
            canvas.lineModeMode = false;
            drawBtn.classList.remove("activedrawbtn");
        }
        else if (!canvas.lineModeMode) {
            canvas.lineModeMode = true;
            drawBtn.classList.add("activedrawbtn");
        }

        canvas.freeDrawingBrush = new fabric['PencilBrush'](canvas);
    }

    function spawnImg() {
        if (!canvasEl) {
            return
        }

        const imageInfo = JSON.parse(canvasEl.dataset.imageInfo);

        //creates fabricjs image object
        fabric.Image.fromURL(imageInfo.url, function (fabricImage) {
            fabricImage.set({
                hasControls: false,
                hasBorders: false,
                lockMovementX: true,
                lockMovementY: true,
                selectable: false,
            });
            //gets image height
            const imageHeight = imageInfo.height;
            const imageWidth = imageInfo.width;

            console.log("Image Height", imageHeight);
            console.log("Image Width", imageWidth);

            // image ratio
            image_ratio_height = imageHeight/imageHeight;
            image_ratio_width = imageWidth/imageHeight;
            console.log(image_ratio_height, ":" , image_ratio_width);

            //determines 'standard' canvas size.
            let image_multiplier = 500;

            let image_height = image_ratio_height * image_multiplier;
            let image_width = image_ratio_width * image_multiplier;

            //sets standard canvas size.
            canvas.setDimensions({width:(image_width), height:(image_height)});

            //canvas height and width in variable
            let canvasHeight = canvas.height;
            let canvasWidth = canvas.width;

            //sets image to fit the canvas size.
            fabricImage.scaleToHeight(canvasHeight);
            fabricImage.scaleToWidth(canvasWidth);

            canvas.add(fabricImage);

            console.log(canvas.height, canvas.width);
        });
    }

    window.onload = function() {
        spawnImg();
    };

    //Function which serializes canvas and should be called on button click.
    function saveCanvas() {
        // Serialize the annotations
        const serialized_annotations = JSON.stringify(canvas);
        console.debug(serialized_annotations);

        // Get the hidden input and place the annotations on the form
        const form = $('#answered');
        let annotations_field = form.find('#annotations').get(0);
        annotations_field.value = serialized_annotations;

        // Return true allows the form submit event to continue
        return true;
    }

    function spawntext() {

        var text = new fabric.IText("Text", {
            fontFamily: 'montserrat',
        });

        // this if statement should be used to check if dark mode is enabled or disabled and based on that choose text color.
        if (2 > 1) {
            text.setColor(objcolor);
        }
        canvas.add(text);
        canvas.centerObject(text);
        canvas.renderAll();
    }

    function spawncube() {
        // create a rectangle object
        var rect = new fabric.Rect({
            stroke: objcolor,
            strokeWidth: 2,
            strokeUniform: true,
            fill: 'rgba(0,0,0,0)',
            width: 400,
            height: 200
        });

        // this if statement should be used to check if dark mode is enabled or disabled and based on that choose text color.
        if (2 > 1) {
            rect.set('stroke', objcolor);
        }

        canvas.add(rect);
        rect.center();
        canvas.renderAll();
    }

    function spawncircle() {
        // create a rectangle object
        let circle = new fabric.Circle({
            radius: 100,
            fill: '',
            stroke: 'black',
            strokeWidth: 3,
        });

        // this if statement should be used to check if dark mode is enabled or disabled and based on that choose text color.
        if (2 > 1) {
            circle.set('stroke', objcolor);
        }

        canvas.add(circle);
        circle.center();
        canvas.renderAll();
    }

    function changetextcolor(clr) {
        let color = clr;
        let obj = canvas.getActiveObject();
        let typecheck = obj.get('type');

        console.log(typecheck);
        if (typecheck == 'circle' || typecheck == 'rect') {
            obj.set('stroke', (color));
            console.log('hey');
        }
        else if (typecheck == 'i-text') {
            obj.set('fill', (color));
        }

        canvas.renderAll();
    }

    function removeactiveobject() {
        var obj = canvas.getActiveObject();
        var typecheck = obj.get('type');
        var activeObject = canvas.getActiveObjects();
        console.log(activeObject)
        console.log(typecheck)
        if (typecheck === 'image') {
            return null;
        }
        else {
            if (activeObject) {
                activeObject.forEach(function (object) {
                    canvas.remove(object);
                });
                canvas.discardActiveObject();
            }
        }
        canvas.renderAll();
    }

    canvas.calcOffset();

}
