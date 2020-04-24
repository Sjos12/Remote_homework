@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($questions as $view_model)
            <div class="row">
                <h3 class="col-6">{{ $view_model->question()->title }}</h3>

                @if($firstImage = $view_model->firstImage())
                    <div class="col-10">
                        {{ $firstImage->img()->attributes(['class' => 'img-fluid', 'alt' => $view_model->question()->title]) }}
                    </div>
                @endif

                <p class="col-10">{{$view_model->question()->content}}</p>
                <div class="text-right col-2">
                    <a class="btn btn-xs btn-primary"
                       href="{{ route('questions.detail', ['question' => $view_model->question()->uuid]) }}"
                    >
                        View Question
                    </a>
                </div>
                <p class="col-12 question-data">
                    Submitted by: {{ $view_model->question()->author->name }}
                </p>
                <p class="col-6 question-data">
                    Posted at: {{ $view_model->question()->created_at->toDateTimeString() }}
                </p>
                <p class="mr-auto col-6 question-data text-right">
                    Last updated at: {{ $view_model->question()->updated_at->toDateTimeString() }}
                </p>

            </div>
            <hr>
        @endforeach
    </div>
@endsection
