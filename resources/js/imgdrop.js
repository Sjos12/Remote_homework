"use strict";
console.log('hello')

window.dragndrop = function(event) {
    var fileName = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("preview");
    preview.setAttribute("src", fileName);
}
window.drag = function() {
    document.getElementById('uploadFile').parentNode.className = 'imagedrop--dragging imagedrop';
}
window.drop = function() {
    document.getElementById('uploadFile').parentNode.className = 'imagedrop';
    document.getElementById("imagedrop__markup").style.display = "none";
    document.getElementById("imgpreview__container").classList.add("imgpreview__container--zhigh");
}