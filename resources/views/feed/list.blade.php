@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-12">
                <div class="card-welcome__content col-10 offset-1">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="title4">Welcome, Denzel</h1>
                            <h2>Questions answered</h2>
                            <h2>Questions asked</h2>
                        </div>
                        <div class="col-6 card-welcome--button-container">
                            <div class="card-welcome--button-container-centered">
                                <button class="card-welcome--button btn btn-primary text-right float-right btn-lg">Create question</button>
                            </div>
                        </div>
                    </div>         
                </div>
            </div>
        </div>
        @foreach($questions as $view_model)
        
        <div class="row">
        <div class="card col-12">
                @if($firstImage = $view_model->firstImage())
                    <div class=" col-lg-4 col-md-4 col-xs-12 col-sm-12 d-flex justify-content-center">
                        {{ $firstImage->img()->attributes(['class' => 'img-fluid d-block mx-auto mt-auto mb-auto rounded', 'alt' => $view_model->question()->title]) }}
                    </div>
                @endif

                <div class="ml-auto pt-4 pb-4 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <h3 class="col-12 title3">{{ $view_model->question()->title }}</h3>
                    <p class="col-12 mb-auto paragraph">{{$view_model->question()->content}}</p>

                    <div class="ml-auto mt-auto mb-auto">
                            <a class="btn btn-lg btn-primary float-right"
                               href="{{ route('feed.detail', ['question' => $view_model->question()->uuid]) }}"
                            >
                                View Question
                            </a>
                    </div>

                    <div class="col-12 d-flex justify-content-center"></div>
                    <h6 class="col-12 ">
                        Asked by: {{ $view_model->question()->author->name }}
                    </h6>
                    <p class="col-6 ">
                        Asked  {{ $view_model->createdSince() }}
                    </p>

                    <p class="col-6">
                        Last updated {{ $view_model->createdSince() }}
                    </p>
`               </div>

            </div>
            </div>
            <hr class="feedhr" id="feedhr">
        
            
        @endforeach

    </div>
@endsection
