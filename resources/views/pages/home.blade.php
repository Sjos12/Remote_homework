@extends('layouts.app')

@section('content')
<div class="container">
  <div class="vh-100">
    <div class="row vh-100">
      <div class="col-md-6">
        <div class="positioncontent">
          <h1 class="title ">Remote Homework</h1> 
          <p class="paragraph">
          An easy and simple online platform to
          remotely collaborate and give feedback on (home)work.
          </p> 
          <div class="wrapper pt-2">
            <a href="{{ route('login') }}" class="shadow-sm btn btn-primary btn-lg border border-info" id="homebtn1">Get Started</a>
            <a href="#content2" class="shadow-sm btn btn-white btn-lg border border-info" id="homebtn2">Contact us here</a>
          </div>  
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <img src="/images/homeworkgirl.svg" class="" id="homeworkgirl" alt="Homework girl">
      </div>
    </div>
  </div>

  <div class="row">
    <h1 class="pt-5 pb-5">Content</h1> 
  </div>

</div>
@endsection
