@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="col-12">{{ $question->title }}</h3>
                <p class="col-12">{{ $question->content }}</p>
            </div>

            <div id="carouselExampleControls" class="carousel slide mx-auto" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        @if($firstImage)
                            <div class="p-5 box">
                                {{ $firstImage->img()->attributes(['class' => 'img-fluid rounded align-middle col-12', 'alt' => $question->title]) }}
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


            <div class="col-8">
                <p class="col-12 question-data">
                    {{ __('Asked by :Author', ['author' => $question->author->name]) }}
                </p>
                <p class="col-12 question-data text-left">
                    {{ __('Question asked :date', ['date' => $question->created_at->diffForHumans()]) }}
                </p>
                <p class="col-12  question-data text-left">
                    {{ __('Last updated :date', ['date' => $question->updated_at->diffForHumans()]) }}
                </p>
                <div class="col-12">
                    @foreach ($question->category as $category)
                        <h6 class="category">{{$category->category }}</h6>
                    @endforeach
                </div>   
            </div>

            <div class="col-4 my-auto">
                <a class="btn btn-primary btn-lg float-right" href="{{ route('questions.edit', ['question' => $question->uuid]) }}">{{ __('Edit question') }}</a>
            </div>
        </div>
    </div>
@endsection
