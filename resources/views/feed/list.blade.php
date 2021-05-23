@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pb-4">
            <div class="card col-12">
                <div class="card-welcome__content col-10 offset-1">
                    <div class="row">

                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 dashboardstat">
                            <h1 class="title4">{{ __('Welcome, :Name!', ['name' => $user['name'],]) }}</h1>
                            <h2>
                                <span class="statistic--color">{{ $user['answered'] }}</span> {{ __('questions answered') }} <br>
                                <span class="statistic--color">{{ $user['asked'] }}</span> {{ __('questions asked') }}
                            </h2>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 card-welcome--button-container">
                            <div class="card-welcome--button-container-centered">

                                <a class="card-welcome--button btn btn-primary btn-lg mt-4 float-right widebutton" href="{{ route('questions.create') }}">{{ __('Create question') }}</a>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 d-flex justify-content-center my-4">
                            <div class="profilepicture-container shadow ml-4">
                                <a href=""><img src="{{ \Illuminate\Support\Facades\Auth::user()->getFirstMediaUrl('profiles') }}" class="h-100" alt=""></a>                
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
                                    @foreach ($view_model->categories() as $category)
                                        <h6 class="category">{{$category->category}}</h6>
                                    @endforeach 
                                </div>

                                <div class=" card--question- mt-auto desktopinfo">
                                    <div class="div1">
                                        <h6 class="card--question--info pt-4">
                                        Asked by <span class="answerauthor">{{ __(':Author', ['author' => $view_model->question()->author->name]) }}</span>  <img src="/images/circle.svg" alt="circle">
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

                           
                            </div>

                            <div class="row">
                                <div class="col-8 card--question- mt-auto mobileinfo">
                                        <div class="div1">
                                            <h6 class="card--question--info pt-4">
                                                {{ __('Asked by :Author', ['author' => $view_model->question()->author->name]) }} <br class="pt-0">
                                                {{ $view_model->createdSince() }}
                                            </h6>
                                        </div>
                                </div>

                                <div class="col-4 mt-auto mb-auto">
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
                @if($questions->isEmpty())
                    <div class="row my-5">
                        <div class="col-12">
                            <img src="/images/empty.svg" alt="" srcset="" class="img--empty">
                            <h1 class="text-center title5 pt-4 pb-4">{{ __('No answers yet!') }}</h1>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
