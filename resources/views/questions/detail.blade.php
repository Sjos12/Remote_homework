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

                    <!-- When the site supports multiple images on 1 answer. Use a if else statement here to only make an extra slide if there is also a                        second image -->
                    <!-- <div class="carousel-item">
                        <img class="d-block w-100" src="..." alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="..." alt="Third slide">
                    </div> -->

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


            <div class="col-8">
                <p class="col-12 question-data">
                    Submitted by: {{ $question->author->name }}
                </p>

                <p class="col-12 question-data text-left">
                    Posted at: {{ $question->created_at->toDateTimeString() }}
                </p>
                <p class="col-12  question-data text-left">
                    Last updated at: {{ $question->updated_at->toDateTimeString() }}
                </p>
            </div>

            <div class="col-4 my-auto">
                <!-- In the future add a marked as solved-->
                <!--<a class="btn btn-primary btn-lg float-right" href="{{ route('feed.answer', ['question' => $question->uuid]) }}">Answer Question</a>-->
                <a class="btn btn-primary btn-lg float-right" href="{{ route('questions.edit', ['question' => $question->uuid]) }}">Edit question</a>
            </div>
        </div>
    </div>
@endsection
