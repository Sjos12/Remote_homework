@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card card--list col-12">
                <div class="row">
                    <div class="row col-10 offset-1">
                        <h1 class="title4 pb-4">{{__('Your questions')}}</h1>
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
                                    <p>{{ $categories }}</p>
                                </div>

                                <div class=" card--question- mt-auto desktopinfo">
                                    <div class="div1">
                                        <h6 class="card--question--info pt-4">
                                            {{ $view_model->createdSince() }}
                                        </h6>
                                    </div>
                                </div>

                            </div>

                            <div class="col-3  mt-auto mb-auto">
                                <a class="desktopinfo btn btn-lg btn-primary float-right pl-5 pr-5"
                                href="{{ route('questions.detail', ['question' => $view_model->question()->uuid]) }}"
                                >
                                    {{ __('View') }}
                                </a>
                                {{-- Leverage Vue JS by start adding components --}}
                                    <button-confirm-delete
                                        confirmation-message="{{ __('Are you sure you want to delete this question?') }}"
                                        endpoint="{{ route('questions.detail', ['question' => $view_model->question()->uuid]) }}"
                                    >
                                        {{ __('Delete') }}
                                    </button-confirm-delete>
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
                                    {{-- Leverage Vue JS by start adding components --}}
                                    <button-confirm-delete
                                        confirmation-message="{{ __('Are you sure you want to delete this question?') }}"
                                        endpoint="{{ route('questions.detail', ['question' => $view_model->question()->uuid]) }}"
                                        class="mobileinfo float-right"
                                    >
                                        {{ __('Delete') }}
                                    </button-confirm-delete>
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
