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
                    >
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
