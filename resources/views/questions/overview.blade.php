@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (empty($questions))
                <h1>Nothing here</h1>
            @endif

            @foreach($questions as $question)
                <div class="row">
                    <h3 class="col-6">{{ $question->title }}</h3>

                    {{-- @todo: is this shares with feed.blade.php, create single template included by both --}}
                    <p class="col-10">{{$question->content}}</p>

                    <div class="text-right col-2">
                        <a class="btn btn-xs btn-primary"
                           href="{{ route('questions.detail', ['question' => $question->uuid]) }}"
                        >
                            View Question
                        </a>
                    </div>
                    <p class="col-12 question-data">
                        Submitted by: {{ $question->author->name }}
                    </p>
                    <p class="col-6 question-data">
                        Posted
                        at: {{ $question->created_at->toDateTimeString() }}
                    </p>
                    <p class="mr-auto col-6 question-data text-right">
                        Last updated
                        at: {{ $question->updated_at->toDateTimeString() }}
                    </p>

                </div>
                @unless($loop->last)<hr>@endunless
            @endforeach
        </div>
    </div>
@endsection
