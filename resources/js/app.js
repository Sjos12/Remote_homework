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
    const imgUrl = canvasElement.data('imageUrl')

    if (!imgUrl) {
        return;
    }

    // @todo: cleanup / add Media ID to JSON on insert already? Perhaps should actually use: http://fabricjs.com/docs/fabric.Canvas.html#toDatalessJSON ? / http://fabricjs.com/docs/fabric.Canvas.html#loadFromDatalessJSON
    let imgAnnotations = canvasElement.data('imageAnnotations')

    console.log(imgAnnotations)

    staticCanvas.loadFromJSON(imgAnnotations)

//    fabric.Image.fromURL(imgUrl, (imgInstance) => {
//        imgInstance.set({
//            hasControls: false,
//            hasBorders: false,
//            lockMovementX: true,
//            lockMovementY: true,
//            selectable: false,
//        })
//
//        const canvasHeight = staticCanvas.height
//        const canvasWidth = staticCanvas.width
//        imgInstance.scaleToHeight(canvasHeight)
//        imgInstance.scaleToWidth(canvasWidth)
//
//        imgAnnotations.forEach(annotation => {
//            // @todo: they have subtypes, not all are paths at all. Check the export and import functions
//            console.log(annotation)
//            //staticCanvas.add(fabric.Path.fromObject(annotation))
//        })
//
//        staticCanvas.add(imgInstance)
//        staticCanvas.renderAll()
//    })
});
