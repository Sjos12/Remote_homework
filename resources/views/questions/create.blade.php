@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="alert alert-danger" role="alert">
                    {{ __('Check form for errors') }}
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <form action="{{ route('questions.store') }}"
                  method="post"
                  class="col-12 col-md-8 offset-md-2"
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
                    >

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Type your question here </label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="content"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload your image</label>
                        <input type="file" class="form-control-file" id="imageupload">
                    </div>

                    <small id="titleHelp" class="form-text text-muted">
                        {{ __('Your question in as terse but specific way as possible') }}
                    </small>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Submit your question') }}</button>
            </form>
        </div>
    </div>
@endsection
