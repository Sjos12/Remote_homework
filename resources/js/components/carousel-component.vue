<template>
<div>
    <button @click="addSlide()" type="button" class="btn btn-primary">Add slide.</button>
    <button @click="removeSlide()" type="button" class="btn btn-secondary">Remove slide</button>
    <div class="carousel-wrapper">
        <div class="carousel" id="carousel">
            <!--<div class="carousel__slide active">
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
            </div>-->
            
            <div v-for="slide in slidesArray" :key="slide.slide" class="carousel__slide " :class="slide.class">
                <h1>Slide {{slide.slide}} </h1>
            </div>
            
            <button type="button" v-on:click="movePrev()" class="carousel__button--previous">
                
                <img src="/images/chevron-left.svg" alt="chevron-left" class="enabled" :class="prevBtnClass">
            </button>
            <button type="button" v-on:click="moveNext()"  class="carousel__button--next" >
                <img src="/images/chevron-right.svg" alt="chevron-right" class="enabled" :class="nextBtnClass">
            </button>
        </div>                          
    </div>
</div>
  
</template>
<script>
export default {
    data() {
        return {
            slides: 2,
            slidesArray: [
                { slide: 0, class: ' active' },
            ],
            activeSlide: 1, 
            prevBtnClass: '', 
            nextBtnClass: ''
        }
    },
    methods: {
        moveNext: function() {
            // If active slide is less than the amount of slides there are.
            if (this.activeSlide < this.slidesArray.length) { 
                this.activeSlide++
                this.moveCarouselTo(this.activeSlide)
            }
            console.log(this.activeSlide);
        },
        movePrev: function() {
            console.log(this.activeSlide)
            if (this.activeSlide >= 0) {
                this.activeSlide--
                this.moveCarouselTo(this.activeSlide)
            }      
        },
        addSlide: function() {
            this.slides++
            this.slidesArray.push(
                { slide: this.slidesArray.length, class: ''}
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
            let total = this.slidesArray.length;
            document.getEl
            let newPrev = slide - 1; 
            let newNext = slide + 1; 

            if (slide === 0) {
                newPrev = null;
            } 
            else if (slide === (total-1)) {
                newNext = null;
            }

            for (let i = 0; i < total; i++) {
                this.slidesArray[i].class = '';
            }
            console.log(this.slidesArray[newPrev])
            this.slidesArray[newPrev] != undefined ? this.slidesArray[newPrev] = ' prev' : this.prevBtnClass = 'disabled';
            this.slidesArray[slide].class= 'active';
            this.slidesArray[newNext] != undefined ? this.slidesArray[newNext] = ' next' : this.nextBtnClass = 'disabled';
            console.log(this.prevBtnClass, this.nextBtnClass)
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