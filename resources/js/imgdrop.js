"use strict";


//
//Carousel logic.
//

//Default value is one slide. 

let itemClassName = "carousel__slide";

let slide = 0;
let moving = true;
let items = document.getElementsByClassName("carousel__slide");
let activeSlide;
var parentdiv = document.getElementById("carousel"); 
let imgSlides = 3; 


// Load initial HTML.
for (let i = 0; i < imgSlides; i++) {
  parentdiv.innerHTML += `
  <div class="carousel__slide">
      <div class="imagedrop document-flex flex-column">

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
              <img id="preview${i}" class="document-block w-100">
          </div>

          <img src="/images/camera.svg" alt="Camera" class="imageicon imgdrop__markup">
          <p class="imgdrop__markup">Drag and drop your image here.</p>
          <p>Slide ${i+2}</p>
      </div>
  </div>`;
};

window.loadHTML = function() {
  var parentdiv = document.getElementById("carousel"); 
  parentdiv.innerHTML += `<div class="carousel__slide">
                            <div class="imagedrop document-flex flex-column">

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
                                    <img id="preview" class="document-block w-100">
                                </div>

                                <img src="/images/camera.svg" alt="Camera" class="imageicon imgdrop__markup">
                                <p class="imgdrop__markup">Drag and drop your image here.</p>
                                <p>Slide ${items.length + 1}</p>
                            </div>
                          </div>`;

}

window.removeHTML = function() {
  //Remove last carousel item.
  if (items.length > 3) {
    items[items.length-1].remove();
  }
  console.log('removed HTML');
}


window.setInitialClasses = function() {
    // Targets the previous, current, and next items
    // This assumes there are at least three items.
    let items = document.getElementsByClassName(itemClassName);
    console.log('Total slides:',items.length)
    let totalItems = items.length;

    if (totalItems.length >= 3) {
      items[totalItems - 1].classList.add("prev");
      items[0].classList.add("active");
      items[1].classList.add("next");
    }
}



window.moveNext = function() {

  let items = document.getElementsByClassName(itemClassName);
    console.log('Total slides:',items.length)
    let totalItems = items.length;

    console.log('next')
    // Check if moving
    if (!moving) {
      // If it's the last slide, reset to 0, else +1
      if (slide === (totalItems - 1)) {
        slide = 0;
      } else {
        slide++;
      }

      window.activeSlide = slide
      // Move carousel to updated slide
      moveCarouselTo(slide);
    }
}

window.movePrev = function() {
  let items = document.getElementsByClassName(itemClassName);
    console.log('Total slides:',items.length)
    let totalItems = items.length;

  console.log('prev')
    // Check if moving
    if (!moving) {
      // If it's the first slide, set as the last slide, else -1
      if (slide === 0) {
        slide = (totalItems - 1);
      } else {
        slide--;
      }
      window.activeSlide = slide
      // Move carousel to updated slide
      moveCarouselTo(slide);
    }
}


  
// Set event listener

window.disableInteraction = function() {
    // Set 'moving' to true for the same duration as our transition.
    // (0.5s = 500ms)
    
    moving = true;
    // setTimeout runs its function once after the given time
    setTimeout(function(){
      moving = false
    }, 500);
}
  
window.moveCarouselTo = function(slide) {

    // Check if carousel is moving, if not, allow interaction
    if(!moving) {
      
      // temporarily disable interactivity
      disableInteraction();
      let items = document.getElementsByClassName(itemClassName);
      console.log('Total slides:',items.length)
      let totalItems = items.length;
      

      // Update the "old" adjacent slides with "new" ones
      var newPrevious = slide - 1,
          newNext = slide + 1,
          oldPrevious = slide - 2,
          oldNext = slide + 2; // 3
      console.log('new slide', slide)

      // Test if carousel has more than three items
      if (totalItems >= 3) {
        // Checks and updates if the new slides are out of bounds
        if (newPrevious <= 0) {
         // oldPrevious = (totalItems - 1);
        } else if (newNext >= (totalItems - 1)){
          //oldNext = 0;
        }
        // Checks and updates if slide is at the beginning/end
        if (slide === 0) {
          newPrevious = (totalItems - 1);
          //oldPrevious = (totalItems - 2);
          //oldNext = (slide + 1);
        } else if (slide === (totalItems -1)) {
          newPrevious = (slide - 1);
          newNext = 0;
          //oldNext = 1;
        }
        // Now we've worked out where we are and where we're going, 
        // by adding/removing classes we'll trigger the transitions.
        // Reset old next/prev elements to default classes

        // Set all slides to default classname
        for(let i = 0; i < items.length; i++ ) {
          items[i].className = itemClassName;
        }
        
        // Add 'special' classes to the right items. 
        items[newPrevious].className = itemClassName + " prev";
        items[slide].className = itemClassName + " active";
        items[newNext].className = itemClassName + " next";
      }
    }
  }

  window.initCarousel = function() {
    setInitialClasses();
    // Set moving to false so that the carousel becomes interactive
    moving = false;
  }

      // Add image slide. 
    window.addSlide = function() {
      
      imgSlides++ 
      loadHTML();
      initCarousel();
    }
    // Remove image slide. 
    window.removeSlide = function() {
      imgSlides--
      removeHTML();
      initCarousel();
    };

initCarousel();


//
// Drag and drop logic. 
//


window.dragndrop = function(event) {
  var fileName = URL.createObjectURL(event.target.files[0]);
  var preview = document.getElementById("preview" + activeSlide);
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
