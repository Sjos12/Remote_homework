<template>
<div>
    <button @click="addSlide()" type="button" class="btn btn-primary">Add slide.</button>
    <button @click="removeSlide()" type="button" class="btn btn-secondary">Remove slide</button>
    <div class="carousel-wrapper">
        <div class="carousel" id="carousel">
            <div v-for="slide in slidesArray" :key="slide.slide" class="carousel__slide " :class="slide.class">
                <h1>Slide {{slide.slide+1}}. Total slides: {{slidesArray.length}}</h1>
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
                    <p>Slide: {{slide.slide+1 }}</p>
                </div>
            </div>
            
            <button type="button" v-on:click="movePrev()" class="carousel__button--previous"  :class="prevBtnClass"  :disabled="isButtonDisabled()[0]">
                
                <i class="fa fa-chevron-left fa-2x"></i>
            </button>
            <button type="button" v-on:click="moveNext()"  class="carousel__button--next" :class="nextBtnClass"  :disabled="isButtonDisabled()[1]" >
                <i class="fa fa-chevron-right fa-2x"></i>
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
            activeSlide: 0, 
            prevBtnClass: '', 
            nextBtnClass: ''
        }
    },
    methods: {
        isButtonDisabled: function() {
            let prevBtnState = this.prevBtnClass == 'disabled' ? true : false;
            let nextBtnState = this.nextBtnClass == 'disabled' ? true : false;   
            console.log(prevBtnState, nextBtnState)
            return [prevBtnState, nextBtnState];
        },

        moveNext: function() {
            // If active slide is less than the amount of slides there are.
            if (this.activeSlide < this.slidesArray.length) { 
                this.activeSlide++
                // 1 based
                this.moveCarouselTo(this.activeSlide)
            }
            console.log(this.activeSlide, 'slidesarray', this.slidesArray);
        },
        movePrev: function() {
            console.log(this.activeSlide)
            if (this.activeSlide >= 0) {
                this.activeSlide--
                // 1 based.
                this.moveCarouselTo(this.activeSlide)
                console.log(this.activeSlide, 'slidesarray', this.slidesArray);
            }      
        },
        addSlide: function() {
            this.slides++
            this.slidesArray.push(
                { slide: this.slidesArray.length, class: ''}
                )
            // Move carousel to the new slide and disable the buttons.
            
            console.log('activeslide', this.activeSlide);
            this.moveCarouselTo(this.activeSlide);           
        }, 
        removeSlide: function() { 
            if (this.slidesArray.length > 0) {
                this.slides--
                let slide = this.slidesArray.indexOf(this.activeSlide);
                this.slidesArray.splice(slide, 1)
                
                this.activeSlide = this.slidesArray[0].slide;
            }
            
        },
        disableInteraction: function () {

        }, 
        moveCarouselTo: function (slide) {
            let total = this.slidesArray.length;
            // Set slideIndex to 0 based instead of 1 based.
            document.getEl
            let newPrev = slide - 1; 
            let newNext = slide + 1; 


            // Set all classes to nothing.
            for (let i = 0; i < this.slidesArray.length; i++) {
                this.slidesArray[i].class = '';
            }
            console.log('slide', slide)
            
            if (this.slidesArray[newPrev] != undefined) {
                // When newPrev is defined
                this.slidesArray[newPrev].class = ' prev'; 
                this.prevBtnClass = 'enabled'
                
            }
            else { 
                this.prevBtnClass = 'disabled';
                console.log('undefined newPrev', newPrev)
            }
            this.slidesArray[slide].class = 'active';

            if (this.slidesArray[newNext] != undefined) {
                // When newPrev is defined
                this.slidesArray[newNext].class = ' next'; 
                this.nextBtnClass = 'enabled'
            }
            else { 
                this.nextBtnClass = 'disabled';
                console.log('undefined newNext', newNext)
            }
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
    }, 
    mounted: function() {
        // Set both buttons to disabled since when this function is called there can only be one slide.
        this.prevBtnClass = 'disabled';
        this.nextBtnClass = 'disabled'
    }
}
</script>