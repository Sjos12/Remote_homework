@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="col-12">{{ $question->title }}</h3>
                <p class="col-12">{{$question->content}}</p>
            </div>

            <div id="carouselExampleControls" class="carousel slide mx-auto" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        @if($firstImage)
                            <div class="p-5 box">
                                {{ $firstImage->img()->attributes(['class' => 'img-fluid rounded detailimg align-middle col-12', 'alt' => $question->title]) }}
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
                <p class="col-12 question-data text-left">
                    Question asked {{ $question->created_at->diffForHumans() }}
                </p>

                <p class="col-12  question-data text-left">
                    Last updated {{ $question->updated_at->diffForHumans() }}
                </p>

                <p class="col-12 question-data">
                    Asked by {{ $question->author->name }}
                </p>
            </div>

            <div class="col-4 my-auto ">
                <a class="btn btn-primary btn-lg float-right " href="{{  route('feed.answer', ['question' => $question->uuid]) }}">Answer Question</a>
            </div>
        </div>

        @if ($answers->isNotEmpty())
            <hr class="feedhr ">
            <h1 class="title pt-3">Answers</h1>
            @foreach($answers as $answer)

                <div class="row answercontainer mb-5 mt-5 p-3">
                    <div class="col-md-6 col-lg-6">
                        <h1 class="my-auto title3 answerauthorcontainer"> <span class="answerauthor ">{{ $answer->author->name }}</span> gave an answer</h1>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <a href="" class="btn btn-primary btn-lg text-right viewanserbtn">View answer</a>
                    </div>
                </div>
            @endforeach
        @else
            <hr class="feedhr pt-5 pb-5">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Be the first to answer!</h1>
                </div>

            </div>
        @endif
    </div>
@endsection
