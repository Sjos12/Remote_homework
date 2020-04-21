@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="col-6">{{ $question->title }}</h3>

            @isset($media)
            <div class="col-10">
                {{-- @todo: this is way too ugly, and will require copy/pasting everywhere the illustration needs to be displayed. Replace with ViewModel --}}
                {{ $media->img()->attributes(['class' => 'img-fluid', 'alt' => $question->title]) }}
            </div>
            @endisset

            <p class="col-10">{{$question->content}}</p>

            <p class="col-12 question-data">
                Submitted by: {{ $question->author->name }}
            </p>
            <p class="col-6 question-data">
                Posted at: {{ $question->created_at->toDateTimeString() }}
            </p>
            <p class="mr-auto col-6 question-data text-right">
                Last updated at: {{ $question->updated_at->toDateTimeString() }}
            </p>
        </div>
    </div>
@endsection
