@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 class="col-6">{{ $question->title }}</h3>
                <p class="col-10">{{$question->content}}</p>
            </div>

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        @if($firstImage)
                            <div class="p-5 mx-auto col-10">
                                {{ $firstImage->img()->attributes(['class' => 'img-fluid rounded', 'alt' => $question->title]) }}
                            </div>
                        @endif
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="..." alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="..." alt="Third slide">
                    </div>
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


            <div class="col-6">
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

            <div class="col-6  my-auto ">
                <a class="btn btn-primary btn-lg float-right ">Answer Question</a>
            </div>
        </div>
    </div>
@endsection
