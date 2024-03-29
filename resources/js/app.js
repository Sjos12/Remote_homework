/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('button-confirm-delete', require('./components/ButtonConfirmDelete.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


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
