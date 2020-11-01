@extends('layouts.app')

@section('content')
<div class="container">
  <div class="vh-100">
    <div class="row vh-100">
      <div class="col-md-6">
        <div class="positioncontent">
          <h1 class="title slide-in-left">{{ __('Remote Homework') }}</h1>
          <p class="paragraph slide-in-left">
              {{ __('site.homepage.intro') }}
          </p>
          <div class="wrapper pt-2">
            <a href="{{ route('login') }}" class="shadow-sm btn btn-primary btn-lg border border-info slide-in-top widebutton" id="homebtn1">{{ __('Get Started') }}</a>
            <a href="#content2" class="shadow-sm btn btn-white btn-lg border border-info slide-in-top widebutton" id="homebtn2">{{ __('Contact us here') }}</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-12 slide-in-right">
        <img src="/images/homeworkgirl.svg" class="" id="homeworkgirl" alt="Homework girl">
      </div>
    </div>
  </div>

<hr class="homehr">

  <div class="row rowspacingbottom mobilespacingtop">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 desktopimg">
      <img src="/images/collaboration.svg" alt="" id="collaboration" srcset="">
    </div>

    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      <h1 class="title slide-in-top">{{ __('Help each other') }}</h1>
      <p class="paragraph">
          {{ __('site.homepage.paragraph2') }}
      </p>
    </div>

    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 mobileimg">
      <img src="/images/collaboration.svg" alt="" id="collaboration" srcset="">
    </div>
  </div>

<hr class="homehr">

  <div class="row rowspacingtop rowspacingbottom">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

      <h1 class="title ">{{ __('Also for teachers') }}.</h1>
      <p class="paragraph">
          {{ __('site.homepage.paragraph3') }}

      </p>
    </div>

    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      <img src="/images/teacher.svg" alt="" id="collaboration" srcset="">
    </div>
  </div>

<hr class="homehr">

  <div class="row rowspacingtop rowspacingbottom">
    <div class="col-12 pb-4">
      <h1 class="title text-center">{{ __('How do I ask a question?') }}</h1>
    </div>

    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 phonecontainer">
      <img src="/images/phone1.svg" alt="" id="phone1" srcset="" class="d-block mt-auto mx-auto">
      <p class="paragraph text-center">{{ __('site.homepage.paragraph4') }}
      </p>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 phonecontainer">
      <img src="/images/phone2.svg" alt="" id="phone2" srcset="" class="d-block my-auto mx-auto">
      <p class="paragraph text-center">
          {!! __('site.homepage.paragraph5', ['href' => route('login')]) !!}
      </p>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 ">
      <img src="/images/phone3.svg" alt="" id="phone3" srcset="" class="d-block mt-auto mx-auto">
      <p class="paragraph text-center">{{ __('site.homepage.paragraph6') }}
      </p>
    </div>

    <h2 class="col-12 title2 d-block mx-auto pt-4">{!! __("Easy? Isn't it? <br> For more, check out our tutorials here.") !!}
    </h2>
    <a href="{{ route('login') }}" class="shadow-sm btn btn-primary btn-lg border border-info d-block mx-auto mt-4" id="homebtn3">
        {{ __('View tutorials') }}
    </a>
  </div>

<hr class="homehr">

  <div class="row rowspacingtop rowspacingbottom">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      <div class="col-12">
        <h1 class="title ">{{ __('What does it cost?') }}</h1>
        <p class="paragraph">
            {{ __('site.homepage.paragraph7') }}
        </p>
      </div>
      <div class="col-12">
        <a href="{{ route('login') }}" class="shadow-sm btn btn-primary btn-lg border border-info mt-4" id="homebtn4">{{ __('Donate') }}</a>
      </div>

    </div>

    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      <img src="/images/superman.svg" alt="" id="collaboration" srcset="">
    </div>
  </div>


</div>
@endsection
