<template>
<div>
    <div class="carousel-wrapper"  v-on:keyup.left="movePrev()" v-on:keyup.right="moveNext()">
        <div class="carousel" id="carousel">
            <div v-for="medium in media" :key="medium.id" class="w-100 carousel__slide " :class="slide.class">  

                <div id="imgpreview__container" class="imgpreview__container pt-3 pb-3 d-flex align-self-center justify-self-center">
                        <img v-bind:id="'preview' + slide.slide" class="d-block h-100" :src="slidesArray[activeSlide].url">
                </div>
                
               
            </div>
            
             <button type="button" v-on:click="movePrev()" class="carousel__button--previous mx-4"  :class="prevBtnClass"  :disabled="isButtonDisabled()[0]">
                    <i class="fa fa-chevron-left fa-2x "></i>
            </button>
            <button type="button" v-on:click="moveNext()"  class="carousel__button--next mx-4   " :class="nextBtnClass" :disabled="isButtonDisabled()[1]">
                <i class="fa fa-chevron-right fa-2x " ></i>
            </button>
                
            <div class="d-flex justify-content-center align-items-center w-100">
                <div v-for="slide in slidesArray" :key="slide.slide" class="mr-1">
                    <i class="fa fa-circle" v-bind:class="{ 'blue fa-lg' : isActiveSlide(slide.slide), 'white fa-sm' : !isActiveSlide(slide.slide) }"></i>
                </div> 
                <button type="button" v-on:click="addSlide()"  class="btn shadow-none enabled z-high">
                    <i class="fa fa-plus fa-2x"></i>
                </button>
            </div>
        </div>              
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            slidesArray: [
                { slide: 0, class: ' active', url: '' },
            ],
            activeSlide: 0, 
            prevBtnClass: '', 
            nextBtnClass: '', 
            previewUrl: [],
        }
    },
    props: ['media'],
    methods: {
        getInputName: function(index) {
            let name = 'illustration' + index;
            return name;
        },
        isImageUrlSet: function() {
            if (this.slidesArray[this.activeSlide].url == '') {
                return false;
            }
            return true;
        },
        isActiveSlide: function(slideIndex) {
            if (slideIndex == this.activeSlide) {
                return true;
            }
            return false;
        },
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
                console.log('this.activeslidemovenext', this.activeSlide)
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
            if (this.slidesArray.length < this.maxSlides) {
                this.slidesArray.push(
                    { slide: this.slidesArray.length, class: '', url: ''}
                )
            // Move carousel to the new slide and disable the buttons.
            
            console.log('activeslide', this.activeSlide);
            this.moveCarouselTo(this.activeSlide);   
            }
                    
        }, 
        removeSlide: function(slide) { 
            console.log('removeSlidArg', this.slidesArray[slide]);
            // When there are more than 0 slides. 
            if (this.slidesArray.length > 1) {
                // Set the new activeSlide
                this.activeSlide = slide-1;
                this.moveCarouselTo(this.activeSlide)
                // Remove the slide. 
                this.slidesArray.splice(slide, 1)
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
            console.log('change')
            this.slidesArray[this.activeSlide].url = URL.createObjectURL(event.target.files[0]);
        }, 
        drag: function() {
            document.getElementById('uploadFile').parentNode.className = 'imagedrop--dragging imagedrop';
        }, 
        drop: function() { 
            console.log('drop')
            document.getElementById('uploadFile').parentNode.className = 'imagedrop';
        }, 
    }, 
    mounted: function() {
        // Set both buttons to disabled since when this function is called there can only be one slide.
        this.prevBtnClass = 'disabled';
        this.nextBtnClass = 'disabled'
        if (this.media.length > 0) { 
            
        }
        console.log(this.media)
    }
}
</script>