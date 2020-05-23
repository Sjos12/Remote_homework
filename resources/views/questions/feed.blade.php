@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($questions as $view_model)
            <div class="row ">
                @if($firstImage = $view_model->firstImage())
                    <div class=" col-lg-4 col-md-4 col-xs-12 col-sm-12 d-flex justify-content-center">
                        {{ $firstImage->img()->attributes(['class' => 'img-fluid d-block mx-auto mt-auto mb-auto', 'alt' => $view_model->question()->title]) }}
                    </div>
                @endif

                <div class="ml-auto pt-4 pb-4 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <h3 class="col-12">{{ $view_model->question()->title }}</h3>
                    <p class="col-12">{{$view_model->question()->content}}</p>

                    <div class="ml-auto mt-auto mb-auto">
                            <a class="btn btn-lg btn-primary float-right"
                               href="{{ route('questions.detail', ['question' => $view_model->question()->uuid]) }}"
                            >
                                View Question
                            </a>
                    </div>

                    <h6 class="col-12 text-left align-items-end">
                        Submitted by: {{ $view_model->question()->author->name }}
                    </h6>
                <div class="row"></div>
                    <p class="col-6 text-left">
                        Posted at: {{ $view_model->question()->created_at->toDateTimeString() }}
                    </p>
                    <p class="text-right align-bottom">
                        Last updated at: {{ $view_model->question()->updated_at->toDateTimeString() }}
                    </p>
`               </div>

            </div>
            <hr class="feedhr" id="feedhr">
        @endforeach
    </div>
@endsection
