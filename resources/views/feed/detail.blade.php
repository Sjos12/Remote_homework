@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card--no-padding">
            <div class="row">
                <div class="card card card--color-2 card--relative pr-5 pl-5 col-md-5 col-lg-5 ">
                    <div class="row">
                        <h3 class="col-12">{{ $question->title }}</h3>
                        <p class="col-12 card__paragraph">{{$question->content}}</p>
                    </div>
                    <div class="row info-container">
                        <div class="col-6">
                            <p class="question-data text-left">
                                {{ __('Question asked :date', ['date' => $question->created_at->diffForHumans()]) }}
                            </p>

                            <p class="question-data text-left">
                                {{ __('Last updated :date', ['date' => $question->updated_at->diffForHumans()]) }}
                            </p>

                            <p class="question-data">
                                {{ __('Asked by :Author', ['author' => $question->author->name]) }}
                            </p>
                        </div>

                        <div class="col-6">
                            <a class="btn btn-primary btn-lg float-right " href="{{  route('feed.answer', ['question' => $question->uuid]) }}">
                                {{ __('Answer Question') }}
                            </a>
                        </div>

                    </div>
                </div>

                <div class="col-md-7">
                    <div id="carouselExampleControls" class="carousel slide mx-auto " data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                @if($firstImage)
                                    <div class="p-5 box">
                                        {{ $firstImage->img()->attributes(['class' => 'img-fluid rounded detailimg align-middle col-12', 'alt' => $question->title]) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{ __('Previous') }}</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{ __('Next') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if ($answers->isNotEmpty())
            <h1 class="title pt-3">{{ __('Answers') }}</h1>
            @foreach($answers as $answer)

                <div class="row answercontainer mb-5 mt-5 p-3">
                    <div class="col-md-6 col-lg-6">
                        <h1 class="my-auto title3 answerauthorcontainer">
                            <span class="answerauthor ">{{ $answer->author->name }}</span> {{ __('gave an answer') }}</h1>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <a href="{{ route('feed.answer', ['question' => $question->uuid]) }}" class="btn btn-primary btn-lg text-right viewanserbtn">{{ __('View answer') }}</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center pt-5">{{ __('Be the first to answer!') }}</h1>
                </div>

            </div>
        @endif
    </div>
@endsection
