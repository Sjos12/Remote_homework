@extends('layouts.app')

@section ('content')
<div class="container">
    <div class="row ">
        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 card card__text--border card--color-2 d-block">
                <h3 class="col-12 title6">{{ $question->title }}</h3>
                <p class="col-12 paragraph--padding paragraph2">{{$question->content}}</p>
                <div class="row container info-container  pb-5">
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
                        @foreach ($question->category as $category)
                            <h6 class="category">{{$category->category }}</h6>
                        @endforeach  
                    </div>

                    <div class="col-6 ">
                        <a class="btn btn-primary btn-lg text-right nowrap" href="{{  route('question.answer', ['question' => $question->uuid]) }}">
                            {{ __('Answer Question') }}
                        </a>
                    </div>
            </div> 
        </div>
        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 card card__img--border card--no-border">
            <div id="carouselExampleControls" class="carousel slide my-auto" data-ride="carousel">
                <div class="carousel-inner">
                    @for ($i = 0; $i < count($question->illustrations()->first()->getMedia('images')); $i++)
                        @if ($i === 0 )
                            <div class="carousel-item active">
                                <img src="{{$question->illustrations()->first()->getMedia('images')[$i]->getUrl()}}" class="rounded detailimg align-middle col-12 imgheight" alt="Image">
                            </div>    
                        @else
                        <div class="carousel-item">
                            <img src="{{$question->illustrations()->first()->getMedia('images')[$i]->getUrl()}}" class="rounded detailimg align-middle col-12 imgheight" alt="Image">
                        </div>
                        @endif
                    @endfor
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            <div id="carouselExampleControls" class="carousel slide mx-auto " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        
                        
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
                            <h1 class="my-auto title5 answerauthorcontainer">
                                <span class="answerauthor">{{ $answer->author->name }}</span> {{ __('gave an answer') }}</h1>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <a href="{{ route('question.answer.show', ['question' => $question->uuid, 'answer' => $answer->uuid]) }}"
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
                        <img src="/images/empty.svg" alt="" srcset="" class="img--empty">
                        <h1 class="text-center title5 pt-4 pb-4">{{ __('No answers yet!') }}</h1>
                    </div>

                </div>
            @endif
        </div>
        
    </div>
</div>
@endsection