"use strict";

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
    let markup = document.getElementsByClassName("imgdrop__markup")
    for (let i = 0; i < markup.length; i++ ) {
        markup[i].style.display = "none";
    }
    document.getElementById("imgpreview__container").classList.add("imgpreview__container--zhigh");
}

//Default value is one slide. 
let imgSlides = 1; 

// Add image slide. 
window.addImage = function() {
    imgSlides++ 
}
// Remove image slide. 
window.removeImage = function() {
    imgSlides-- 
}

let parentdiv = document.getElementById("carousel-inner"); 
for (let i = 0; i < imgSlides; i++) {
    parentdiv.innerHTML += `
    <div class="carousel-item">
        <div class="imagedrop d-flex flex-column">

            <input 
            name="illustration"
            class="imgdrop__input" 
            type="file" 
            onChange="dragndrop(event)"  
            ondragover="drag()" 
            ondrop="drop()" 
            id="uploadFile" 
            required="required"
            />
            
            <div id="imgpreview__container" class="imgpreview__container pt-3 pb-3">
                <img id="preview" class="d-block w-100">
            </div>

            <img src="/images/camera.svg" alt="Camera" class="imageicon imgdrop__markup">
            <p class="imgdrop__markup">Drag and drop your image here.</p>
        </div>
    </div>
    }`
}