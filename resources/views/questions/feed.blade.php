@extends('layouts.app')

@section('content')
    <div class="container">
                    @foreach($questions as $question)
                            <h3 class="">{{ $question->title }}</h3>
                            <p class="">{{$question->content}}</p>
                            <p class="">Submitted by: {{ $question->author->name }}</p>
                            <p class="ml-auto">{{ $question->created_at->toDateTimeString() }}</p>
                            <p class="mr-auto">{{ $question->updated_at->toDateTimeString() }}</p>
                        <hr>
                    @endforeach
    </div>
@endsection
