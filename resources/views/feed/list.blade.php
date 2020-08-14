@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pb-5">
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


        <div class="row">     
            <div class="card card--list col-12"> 
                <div class="row">
                    <div class="col-10 offset-1">
                        <h1>Public</h1>
                        <h1>Private</h1>
                    </div>
                </div>  
            @foreach($questions as $view_model)
                <div class="row">
                    <div class="card card--question col-12">
                        <div class="row col-10 offset-1">
                            <div class="content-container ml-auto p-0 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                                <h3 class="title5">{{ $view_model->question()->title }}</h3>
                                <p class="mb-auto paragraph">{{$view_model->question()->content}}</p>

                                <div class="ml-auto mt-auto mb-auto">
                                        <a class="btn btn-lg btn-primary float-right"
                                        href="{{ route('feed.detail', ['question' => $view_model->question()->uuid]) }}"
                                        >
                                            View Question
                                        </a>
                                </div>

                                <div class="col-12 d-flex justify-content-center"></div>
                                <h6 class="">
                                    Asked by: {{ $view_model->question()->author->name }}
                                </h6>
                                <p class="">
                                    Asked  {{ $view_model->createdSince() }}
                                </p>

                                <p class="">
                                    Last updated {{ $view_model->createdSince() }}
                                </p>
                            </div>
                            
                            @if($firstImage = $view_model->firstImage())
                                <div class="img-container col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="img-box">
                                        {{ $firstImage->img()->attributes(['class' => 'question-img img-fluid d-block mx-auto mt-auto mb-auto rounded', 'alt' => $view_model->question()->title]) }}
                                    </div>
                                </div>

                                <!-- <div class=" col-lg-4 col-md-4 col-xs-12 col-sm-12 d-flex justify-content-center">
                                
                                </div> -->
                            @endif
                        </div>
                    </div>
                </div>    
            </div>
        </div>          
        @endforeach

    </div>
@endsection
