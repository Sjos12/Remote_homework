@extends('layouts.app')

@section('content')
 <div class="container">
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
        <div class="row">
            <form action="{{ route('questions.store') }}"
                  method="post"
                  class="col-12 col-md-8 offset-md-2"
                  enctype="multipart/form-data"
            >
                @csrf
                <div class="form-group">
                    <label for="title">{{ __('Your question') }}</label>
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

                <div class="form-group">
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

                <div class="form-group">
                    <label for="illustration">
                        {{ __('Upload your image') }}
                    </label>
                    <input type="file"
                           class="form-control-file @error('illustration') is-invalid @enderror"
                           id="illustration"
                           name="illustration"
                           aria-describedby="illustrationHelp"
                           required="required"
                    >
                    <small id="illustrationHelp" class="form-text text-muted">
                        {{ __('Upload an image of the subject matter') }}
                    </small>
                    @error('illustration')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                        class="btn btn-primary">{{ __('Submit your question') }}</button>
            </form>
        </div>
    </div>
@endsection
