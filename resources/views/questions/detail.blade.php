@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="col-6">{{ $question->title }}</h3>
            <p class="col-10">{{$question->content}}</p>

            @if($firstImage)
            <div class="p-5 mx-auto col-10">
                {{ $firstImage->img()->attributes(['class' => 'img-fluid', 'alt' => $question->title]) }}
            </div>
            @endif
    
                <p class="col-12 question-data">
                    Submitted by: {{ $question->author->name }}
                </p>
                 
            <p class="col-6 question-data text-left">
                    Posted at: {{ $question->created_at->toDateTimeString() }}
                </p>
                <p class="col-6 question-data text-right">
                    Last updated at: {{ $question->updated_at->toDateTimeString() }}
                </p>
        </div>
    </div>
@endsection
