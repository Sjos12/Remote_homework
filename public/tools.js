// reference canvas element (with id="c")
// create a wrapper around native canvas element (with id="c")
const canvas = new fabric.Canvas('canvas'); 

// variable which chooses color of objects
const objcolor = 'white';
var coll = document.getElementsByClassName("collapsible");
var i;

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

function spawnImg() {
    const image = document.getElementById('answerimg');

    //creates fabricjs image object
    let fabricImage = new fabric.Image(image, {
        hasControls: false,
        hasBorders: false,
        lockMovementX: true,
        lockMovementY: true,
        selectable: false,
    });

    //takes image height and width and puts it in variable
    let imageHeight = fabricImage.height; 
    let imageWidth = fabricImage.width;
    let minimizeFactor = 2;  

    let smallImageHeight = imageHeight / minimizeFactor; 
    let smallImageWidth = imageWidth / minimizeFactor;

    //sets canvas size.
    canvas.setDimensions({width:(smallImageWidth), height:(smallImageHeight)});

    //sets image to fit the canvas size. 
    fabricImage.scaleToHeight(canvasHeight);
    fabricImage.scaleToWidth(canvasWidth);

    console.log(imageHeight);
    //canvas.setDimensions({width:imageWidth, height:imageHeight});
    //canvas.loadFromJSON(//put here the JSON from backend);
    canvas.add(fabricImage);

    //renders everything
    canvas.renderAll();

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
    let annotations_field = form.children('#annotations').get(0);
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
    var circle = new fabric.Circle({
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
    var color = clr;
    var obj = canvas.getActiveObject();
    var typecheck = obj.get('type');

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


