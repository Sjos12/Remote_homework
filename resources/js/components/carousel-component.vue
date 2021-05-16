<template>
<div>
    <button @click="addSlide()" type="button" class="btn btn-primary">Add slide.</button>
    <button @click="removeSlide()" type="button" class="btn btn-secondary">Remove slide</button>
    <div class="carousel-wrapper">
        <div class="carousel" id="carousel">
            <div class="carousel__slide active">
                <div class="imagedrop d-flex flex-column">
        
                    <input 
                    name="illustration"
                    class="imgdrop__input" 
                    type="file" 
                    @change="dragndrop($event)"  
                    @dragover="drag()" 
                    @drop="drop()" 
                    id="uploadFile" 
                    required="required"
                    />
                    
                    <div id="imgpreview__container" class="imgpreview__container pt-3 pb-3">
                        <img id="preview" class="d-block w-100">
                    </div>
        
                    <img src="/images/camera.svg" alt="Camera" class="imageicon imgdrop__markup">
                    <p class="imgdrop__markup">Drag and drop your image here.</p>
                    <p>Slide: 1</p>
                </div>
            </div>
            
            <div v-for="slide in slidesArray" :key="slide.slide">
                <h1>Slide {{slide.slide}} </h1>
            </div>
            
            <button type="button" v-on:click="movePrev()" class="carousel__button--previous">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path fill="none" d="M0 0h24v24H0z"/><path d="M10.828 12l4.95 4.95-1.414 1.414L8 12l6.364-6.364 1.414 1.414z" fill="rgba(255,255,255,1)"/></svg>
                
            </button>
            <button type="button" v-on:click="moveNext()"  class="carousel__button--next">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path fill="none" d="M0 0h24v24H0z"/><path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z" fill="rgba(255,255,255,1)"/></svg>
            </button>
        </div>                          
    </div>
</div>
  
</template>
<script>
export default {
    data() {
        return {
            slides: 0,
            slidesArray: [
                { slide: 0 },
            ],
            activeSlide: 0, 
        }
    },
    methods: {
        moveNext: function() {
            // If active slide is less than the amount of slides there are.
            if (this.activeSlide < this.slidesArray.length) { 
                this.activeSlide++
            }
            console.log(this.activeSlide);
        },
        movePrev: function() {
            if (this.activeSlide >= 0) {
                this.activeSlide--
            }      
        },
        addSlide: function() {
            this.slides++
            this.slidesArray.push(
                { slide: this.slidesArray.length }
                )
            console.log(this.slidesArray);
        }, 
        removeSlide: function() { 
            if (this.slidesArray.length > 0) {
                this.slides--
                let index = this.slidesArray.indexOf(this.activeSlide);
                this.slidesArray.splice(index, 1)
                
                this.activeSlide = this.slidesArray[0].slide;
            }
            
        },
        disableInteraction: function () {

        }, 
        moveCarouselTo: function (slide) {

        }, 
        dragndrop: function(event) {
            var fileName = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");
            preview.setAttribute("src", fileName);
        }, 
        drag: function() {
            document.getElementById('uploadFile').parentNode.className = 'imagedrop--dragging imagedrop';
        }, 
        drop: function() { 
            console.log('drop')
            document.getElementById('uploadFile').parentNode.className = 'imagedrop';
            let markup = document.getElementsByClassName("imgdrop__markup")
            for (let i = 0; i < markup.length; i++ ) {
                markup[i].style.display = "none";
            }
                document.getElementById("imgpreview__container").classList.add("imgpreview__container--zhigh");
        }, 
    }
}
</script>