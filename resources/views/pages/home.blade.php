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

<hr class="homehr"> 

  <div class="row rowspacingbottom mobilespacingtop">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 desktopimg">
      <img src="/images/collaboration.svg" alt="" id="collaboration" srcset="">
    </div>
    
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      <h1 class="title ">Help each other</h1> 
      <p class="paragraph">
      Remote Homework makes helping each other with homework a piece of cake. You can reach out to our community as well as to your teacher or parents and ask them questions on your homework remotely. 

      </p> 
    </div>

    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 mobileimg">
      <img src="/images/collaboration.svg" alt="" id="collaboration" srcset="">
    </div>
  </div>

<hr class="homehr"> 

  <div class="row rowspacingtop rowspacingbottom">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      
      <h1 class="title ">Also for teachers.</h1> 
      <p class="paragraph">
      No more messing about with photoshop trying to add comments or feedback on your students work. With Remote Homework all your stuff is in one place. You can easily give comments and feedback on students work with our built-in image editor
      </p>
    </div>
    
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      <img src="/images/teacher.svg" alt="" id="collaboration" srcset="">
    </div>
  </div>

<hr class="homehr"> 

  <div class="row rowspacingtop rowspacingbottom">
    <div class="col-12 pb-4">
      <h1 class="title text-center">How do I ask a question?</h1>
      <!--<p class="paragraph text-center">
      Following these 3 steps, you will understand the very basics of how to ask homework questions privately and publicly. 
      </p>-->
    </div>

    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 phonecontainer">
      <img src="/images/phone1.svg" alt="" id="phone1" srcset="" class="d-block mt-auto mx-auto">
      <p class="paragraph text-center">Make a picture of the assignment you're struggling with. 
      </p>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 phonecontainer">
      <img src="/images/phone2.svg" alt="" id="phone2" srcset="" class="d-block my-auto mx-auto">
      <p class="paragraph text-center">Make a picture of the assignment you're struggling with. 
      </p>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 ">
      <img src="/images/phone3.svg" alt="" id="phone3" srcset="" class="d-block mt-auto mx-auto">
      <p class="paragraph text-center">Make a picture of the assignment you're struggling with. 
      </p>
    </div>

    <h2 class="col-12 title2 d-block mx-auto pt-4">Easy? Isn't it? </br> For more, check out our tutorials here. 
    </h2>
    <a href="{{ route('login') }}" class="shadow-sm btn btn-primary btn-lg border border-info d-block mx-auto mt-4" id="homebtn3">View tutorials</a>
  </div>

<hr class="homehr"> 

  <div class="row rowspacingtop rowspacingbottom">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      <div class="col-12">
        <h1 class="title ">What does it cost? </h1> 
        <p class="paragraph">
          Remote Homework is currently completely free. We plan to add paid subscriptions in the future for extra features though. You can always donate here.  
        </p>
      </div>
      <div class="col-12">
        <a href="{{ route('login') }}" class="shadow-sm btn btn-primary btn-lg border border-info mt-4" id="homebtn4">Donate</a>
      </div>
      
    </div>

    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
      <img src="/images/superman.svg" alt="" id="collaboration" srcset="">
    </div>
  </div>


</div>
@endsection
