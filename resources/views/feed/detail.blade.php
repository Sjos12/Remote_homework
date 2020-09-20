@extends('layouts.app')

@section ('content')
<div class="container">
    <div class="row ">
        <div class="col-5 card card__text--border card--color-2 d-block">
                <h3 class="col-12 title6">{{ $question->title }}</h3>
                <p class="col-12 paragraph2">{{$question->content}}</p>
                <div class="row container info-container pb-5">
                    <div class="col-6">
                        <h6 class="question-data text-left">
                            {{ __('Asked :date', ['date' => $question->created_at->diffForHumans()]) }}
                        </h6>

                        <h6 class="question-data text-left">
                            {{ __('Updated :date', ['date' => $question->updated_at->diffForHumans()]) }}
                        </h6>

                        <h6 class="question-data">
                            {{ __('Asked by :Author', ['author' => $question->author->name]) }}
                        </h6>
                    </div>

                    <div class="col-6">
                        <a class="btn btn-primary btn-lg text-right nowrap" href="{{  route('feed.answer', ['question' => $question->uuid]) }}">
                            {{ __('Answer Question') }}
                        </a>
                    </div>
            </div> 
        </div>
        <div class="col-7 card card__img--border card--no-border ">
            <div id="carouselExampleControls" class="carousel slide mx-auto " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        @if($firstImage)
                            <div class="p-5 box">
                                {{ $firstImage->img()->attributes(['class' => 'img-fluid rounded detailimg align-middle col-12 imgheight', 'alt' => $question->title]) }}
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

        <div class="card  card--no-border card__answer--border container w-100 pb-0">
        @if ($answers->isNotEmpty())
               <!--<h1 class="title pt-3">{{ __('Answers') }}</h1>-->
                @foreach($answers as $answer)

                    <div class="row answercontainer p-3">
                        <div class="col-md-6 col-lg-6">
                            <h1 class="my-auto title3 answerauthorcontainer">
                                <span class="answerauthor ">{{ $answer->author->name }}</span> {{ __('gave an answer') }}</h1>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="{{ route('feed.answer.show', ['question' => $question->uuid, 'answer' => $answer->uuid]) }}"
                               class="btn btn-primary btn-lg text-right viewanserbtn"
                            >
                                {{ __('View answer') }}
                            </a>
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
        
    </div>
</div>
@endsection