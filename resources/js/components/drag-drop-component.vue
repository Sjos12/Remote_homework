<template>
<div>
    <h1>Hi {{counter }}</h1>
    <div class="carousel-wrapper">
        <div class="carousel" id="carousel">
            <div class="carousel__slide active">
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
                    <p>Slide: 1</p>
                </div>
            </div>
            
            <button type="button"  class="carousel__button--previous">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path fill="none" d="M0 0h24v24H0z"/><path d="M10.828 12l4.95 4.95-1.414 1.414L8 12l6.364-6.364 1.414 1.414z" fill="rgba(255,255,255,1)"/></svg>
                
            </button>
            <button type="button" v-on:click="foo()"  class="carousel__button--next">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path fill="none" d="M0 0h24v24H0z"/><path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z" fill="rgba(255,255,255,1)"/></svg>
            </button>
        </div>                          
  </div>
</div>
  
</template>
<script>
export default {
 data: { 
        items: [ 
            'cheese', 'cheesy', 'meezly', 'wheezly'
        ], 
        counter: 0,
    },
    methods: {
        foo: function() {
            console.log('dosomething');
        }
    }
}
</script>