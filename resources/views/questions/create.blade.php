@extends('layouts.app')

@section('content')
 <div class="container card vh-150">
        @if ($errors->any())
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sm-offset-md-2">
                    <div class="alert alert-danger" role="alert">
                        @if($errors->has('general'))
                            {{ __('Error occurred while saving:') }}
                            <ul>
                                @foreach($errors->get('general') as $general_error)
                                    <li>{{ $general_error }}</li>
                                @endforeach
                            </ul>
                            <br/>
                        @endif
                        {{ __('Check form for field errors') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-center mb-4">
            <span class="circle"><h1>1</h1></span>
            <span class="circle"><h1>2</h1></span>
        </div>
        
        <form action="{{ route('questions.store') }}"
            method="post"
            enctype="multipart/form-data"
            id="myDropzone"
            > @csrf
            <div class="">
                <div class="tab">
                    <div class="row">
                            <div class="form-group col-12 col-md-8 offset-md-2">
                                <h4 class="text-center">Choose your question type</h4>
                                <div class="d-flex justify-content-center">
                                    <h1 type="button" class="title6 font-white typebtn activebtn" onclick="questionType(1)">Public</h1> 
                                    <h1 type="button" class="title6 font-white typebtn" onclick="questionType(2)">Private</h1>
                                </div>
                                <div class="type">
                                    <h4>Choose a category</h4>
                                    
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li class="d-flex my-4"><input type="checkbox" name="categories[]" value="{{$category->id}}"><p class="m-0 ml-2 ">{{ $category->category }}</p></li>
                                        @endforeach
                                    </ul>
                                    
                                </div>

                                <div class="type">
                                    <h4>Choose a receiver</h4>
                                    <input type="text" class="form-control" name="receiver">
                                </div>
                            </div>
                    </div>
                </div>

                <div class="tab">
                    <div class="row">
                        <div class="form-group col-12 col-md-8 offset-md-2">
                            <label for="title">{{ __("Question title") }}</label>
                            <input type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    name="title"
                                    aria-describedby="titleHelp"
                                    required="required"
                                    value="{{ old('title') }}"
                            >
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-12 col-md-8 offset-md-2">
                            <label for="content">
                                {{ __('Your question') }}
                            </label>
                            <textarea id="content"
                                        class="form-control @error('content') is-invalid @enderror contentarea"
                                        rows="5"
                                        name="content"
                                        aria-describedby="contentHelp"
                            >{{ old('content') }}</textarea>
                            <small id="contentHelp" class="form-text text-muted">
                                {{ __('Describe in as much detail as possible exactly the question you have') }}
                            </small>
                            @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-md-8 offset-md-2">
                            <button onclick="addSlide()" type="button" class="btn btn-primary">
                                Add slide.
                            </button>
                            <button onclick="removeSlide()" type="button" class="btn btn-secondary">Remove slide</button>
                        </div>
                        <div class="form-group col-12 col-md-8 offset-md-2">
                            <div id="app">
                                @{{message}}
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-8 offset-md-2" id="form-group__imagedrop">
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
                                    
                                    <button type="button" onclick="movePrev()" class="carousel__button--previous">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path fill="none" d="M0 0h24v24H0z"/><path d="M10.828 12l4.95 4.95-1.414 1.414L8 12l6.364-6.364 1.414 1.414z" fill="rgba(255,255,255,1)"/></svg>
                                        
                                    </button>
                                    <button type="button" onclick="moveNext()" class="carousel__button--next">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path fill="none" d="M0 0h24v24H0z"/><path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z" fill="rgba(255,255,255,1)"/></svg>
                                    </button>
                                </div>
                               
                            </div>
                        </div>
                </div>  
            </div>
        </form>
        <div class="button-group col-12 col-md-8 offset-md-2">
            
            <button class="btn btn-lg  btn-primary float-right" id="nextBtn" onclick="nextPrev(1)">{{ __('Next') }}</button>
            <button class="btn btn-lg  btn-transparent float-right" id="prevBtn" onclick="nextPrev(-1)">{{ __('Previous') }}</button>
        </div>
        
    </div>
</div>
@endsection
