$( document ).ready(function() {
    console.log( "Rendering static canvas" );

    const canvasElement = $('#staticCanvas');

    if (!canvasElement) {
        return;
    }

    const staticCanvas = new fabric.StaticCanvas(canvasElement[0])
//    const imgUrl = canvasElement.data('imageUrl')
//
//    if (!imgUrl) {
//        return;
//    }
//
    // @todo: cleanup / add Media ID to JSON on insert already? Perhaps should actually use: http://fabricjs.com/docs/fabric.Canvas.html#toDatalessJSON ? / http://fabricjs.com/docs/fabric.Canvas.html#loadFromDatalessJSON
    let imgAnnotations = canvasElement.data('imageAnnotations')

    console.log(imgAnnotations)
//
//    staticCanvas.loadFromJSON(imgAnnotations)

    const imageInfo = canvasElement.data('imageInfo');

    //creates fabricjs image object
    staticCanvas.loadFromJSON(
        imgAnnotations,
        () => {
            /*console.log('render callback')
            console.debug(staticCanvas.getObjects());
            staticCanvas.renderAll.bind(staticCanvas)*/
        },
        (jsonObject, fabricObject) => {
            if ('image' !== fabricObject.type) {
                return
            }

            fabricObject.set({
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
            image_ratio_height = imageHeight / imageHeight;
            image_ratio_width = imageWidth / imageHeight;
            console.log(image_ratio_height, ":", image_ratio_width);

            //determines 'standard' canvas size.
            let image_multiplier = 500;

            let image_height = image_ratio_height * image_multiplier;
            let image_width = image_ratio_width * image_multiplier;

            //sets standard canvas size.
            staticCanvas.setDimensions(
                {width: (image_width), height: (image_height)});

            //canvas height and width in variable
            let canvasHeight = staticCanvas.height;
            let canvasWidth = staticCanvas.width;

            //sets image to fit the canvas size.
            fabricObject.scaleToHeight(canvasHeight);
            fabricObject.scaleToWidth(canvasWidth);

            staticCanvas.add(fabricObject);

            console.log(staticCanvas.height, staticCanvas.width);
        });

//    //creates fabricjs image object
//    fabric.Image.fromURL(imageInfo.url, (fabricImage) => {
//        fabricImage.set({
//            hasControls: false,
//            hasBorders: false,
//            lockMovementX: true,
//            lockMovementY: true,
//            selectable: false,
//        });
//        //gets image height
//        const imageHeight = imageInfo.height;
//        const imageWidth = imageInfo.width;
//
//        console.log("Image Height", imageHeight);
//        console.log("Image Width", imageWidth);
//
//        // image ratio
//        image_ratio_height = imageHeight/imageHeight;
//        image_ratio_width = imageWidth/imageHeight;
//        console.log(image_ratio_height, ":" , image_ratio_width);
//
//        //determines 'standard' canvas size.
//        let image_multiplier = 500;
//
//        let image_height = image_ratio_height * image_multiplier;
//        let image_width = image_ratio_width * image_multiplier;
//
//        //sets standard canvas size.
//        staticCanvas.setDimensions({width:(image_width), height:(image_height)});
//
//        //canvas height and width in variable
//        let canvasHeight = staticCanvas.height;
//        let canvasWidth = staticCanvas.width;
//
//        //sets image to fit the canvas size.
//        fabricImage.scaleToHeight(canvasHeight);
//        fabricImage.scaleToWidth(canvasWidth);
//
//        staticCanvas.add(fabricImage);
//
//        console.log(staticCanvas.height, staticCanvas.width);
//    });
});
