@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pb-5">
            <div class="card col-12">
                <div class="card-welcome__content col-10 offset-1">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 dashboardstat">
                            <h1 class="title4">{{ __('Welcome, :Name', ['name' => \Illuminate\Support\Facades\Auth::user()->name,]) }}</h1>
                            <h2>
                                {{ __('Questions answered') }} <br>
                                {{ __('Questions asked') }}
                            </h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 card-welcome--button-container">
                            <div class="card-welcome--button-container-centered">

                                <a class="card-welcome--button btn btn-primary btn-lg mt-4" href="{{ route('questions.create') }}">{{ __('Create question') }}</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="card card--list col-12">
                <div class="row">
                    <div class="row col-10 offset-1">
                        <a href="" class="link link--active">{{ __('Public') }}</a>
                        <a href="" class="link link--inactive">{{ __('Private') }}</a>
                    </div>
                </div>
            @foreach($questions as $view_model)
                <div class="row row-height pb-5 pl-4 pr-4">
                    <div class="card card--question card--shadow card--question--padding col-12">
                        <div class="row p-0 col-10 offset-1">
                            <div class="content-container ml-auto p-0 col-lg-5 col-md-5 col-sm-12 col-xs-12">

                                <div class="">
                                    <h3 class="title6">{{ $view_model->question()->title }}</h3>

                                    <p class="question-paragraph mb-auto paragraph2">{{$view_model->question()->content}}</p>
                                </div>

                                <div class=" card--question- mt-auto desktopinfo">
                                    <div class="div1">
                                        <h6 class="card--question--info pt-4">
                                            {{ __('Asked by :Author', ['author' => $view_model->question()->author->name]) }} <img src="/images/circle.svg" alt="circle">
                                            {{ $view_model->createdSince() }}
                                        </h6>
                                    </div>
                                </div>

                            </div>

                            <div class="col-3 d-flex justify-content-center mt-auto mb-auto">
                                <a class="desktopinfo btn btn-lg btn-primary float-right pl-5 pr-5"
                                href="{{ route('feed.detail', ['question' => $view_model->question()->uuid]) }}"
                                >
                                    {{ __('View') }}
                                </a>
                            </div>

                            @if($firstImage = $view_model->firstImage())
                                <div class="img-container col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="img-box">
                                        {{ $firstImage->img()->attributes(['class' => 'question-img img-fluid d-block mx-auto mt-auto mb-auto rounded', 'alt' => $view_model->question()->title]) }}
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                            <div class="col-10 card--question- mt-auto mobileinfo">
                                    <div class="div1">
                                        <h6 class="card--question--info pt-4">
                                            {{ __('Asked by :Author', ['author' => $view_model->question()->author->name]) }} <img src="/images/circle.svg" alt="circle">
                                            {{ $view_model->createdSince() }}
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2 d-flex justify-content-center mt-auto mb-auto">
                                <a class="mobileinfo btn btn-lg btn-primary float-right pl-5 pr-5"
                                href="{{ route('feed.detail', ['question' => $view_model->question()->uuid]) }}"
                                >
                                    {{ __('View') }}
                                </a>
                            </div>
                            </div>
                            

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
