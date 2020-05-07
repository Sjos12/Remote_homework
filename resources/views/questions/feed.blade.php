@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($questions as $view_model)
            <div class="row pt-4 pb-4">
                @if($firstImage = $view_model->firstImage())
                    <div class=" col-lg-4 col-md-4 col-xs-12 col-sm-12">
                        {{ $firstImage->img()->attributes(['class' => 'img-fluid  pt-4 pb-4', 'alt' => $view_model->question()->title]) }}
                    </div>
                @endif
                <div class="pt-4 col-6"> 
                    <h3 class="">{{ $view_model->question()->title }}</h3>
                    <p class="">{{$view_model->question()->content}}</p>
`               </div>
                <div class=" ml-auto mt-auto mb-auto col-2">
                    <a class="btn btn-lg btn-primary float-right"
                       href="{{ route('questions.detail', ['question' => $view_model->question()->uuid]) }}"
                    >
                        View Question
                    </a>
                </div>
                <h6 class="col-12 pt-3  text-left">
                    Submitted by: {{ $view_model->question()->author->name }}
                </h6>
                
                <p class="col-6 question-data float-left">
                    Posted at: {{ $view_model->question()->created_at->toDateTimeString() }}
                </p>
                <hr id="feedhr">
                <p class="col-6 question-data text-right">
                    Last updated at: {{ $view_model->question()->updated_at->toDateTimeString() }}
                </p>
            </div>
            <hr class="feedhr" id="feedhr">
        @endforeach
    </div>
@endsection
