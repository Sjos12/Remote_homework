@extends('layouts.app')

@section('content')
 <div class="container vh-100">
        @if ($errors->any())
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
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
        <div class="card">
            <form action="{{ route('questions.store') }}"
                            method="post"
                            class=""
                            enctype="multipart/form-data"
                    >
                <div class="tab">
                    <div class="row">
                        <div class="form-group col-12 col-md-8 offset-md-2">
                            <h4 class="text-center">Choose your question type</h4>
                            <div class="d-flex justify-content-center">
                                <h1 type="button" class="title6 font-white typebtn" onclick="questionType(1)">Public</h1> 
                                <h1 type="button" class="title6 font-white typebtn" onclick="questionType(2)">Private</h1>
                            </div>
                            <div class="type">
                               <h1>type1</h1> 
                            </div>
                            <div class="type">
                                <h1>type2</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab">
                    <div class="row">
                        @csrf
                        <div class="form-group col-12 col-md-8 offset-md-2">
                            <label for="title">{{ __("Your question's title") }}</label>
                            <input type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    name="title"
                                    aria-describedby="titleHelp"
                                    placeholder="Type a title for your question"
                                    required="required"
                                    value="{{ old('title') }}"
                            >
                            <small id="titleHelp" class="form-text text-muted">
                                {{ __('Your question in as terse but specific way as possible') }}
                            </small>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-12 col-md-8 offset-md-2">
                            <label for="content">
                                {{ __('Type your question here') }}
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
                            <label for="illustration">
                                {{ __('Upload your image') }}
                            </label>
                            <input type="file"
                                    class="form-control-file @error('illustration') is-invalid @enderror"
                                    id="illustration"
                                    name="illustration"
                                    aria-describedby="illustrationHelp"
                                    required="required"
                                    onchange="document.getElementById('imgpreview').src = window.URL.createObjectURL(this.files[0])"
                            >
                            <small id="illustrationHelp" class="form-text text-muted">
                                {{ __('Upload an image of the subject matter') }}
                            </small>
                            @error('illustration')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>                 
                    
                        <div class="imgpreview__container pt-3 pb-3 ">
                                <img id="imgpreview" class="col-12 col-md-8 offset-md-2">
                        </div>
                </div>    
        </div>
        <div class="form-group col-12 col-md-8 offset-md-2">
            
            <button class="btn btn-lg btn-primary float-right" id="nextBtn" onclick="nextPrev(1)">{{ __('') }}</button>
            <button class="btn bnt-lg btn-primary float-right" id="prevBtn" onclick="nextPrev(-1)">{{ __('Previous') }}</button>
        </div>
        </form>
    </div>
</div>
@endsection
