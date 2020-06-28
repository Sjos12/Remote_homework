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

  <div class="row pb-5">
    <div class="col-6">
      <img src="/images/collaboration.svg" alt="" id="collaboration" srcset="">
    </div>
    
    <div class="col-6">
      <h1 class="title ">Help each other</h1> 
      <p class="paragraph">
      Remote Homework makes helping each other with homework a piece of cake. You can reach out to our community as well as to your teacher or parents and ask them questions on your homework remotely. 

      </p> 
    </div>
  </div>

  <div class="row pt-5 pb-5">
    <div class="col-6">
      
      <h1 class="title ">Also for teachers.</h1> 
      <p class="paragraph">
      No more messing about with photoshop trying to add comments or feedback on your students work. With Remote Homework all your stuff is in one place. You can easily give comments and feedback on students work with our built-in image editor
      </p>
    </div>
    
    <div class="col-6">
      <img src="/images/teacher.svg" alt="" id="collaboration" srcset="">
    </div>
  </div>

  <div class="row pt-5 pb-5">
    <div class="col-12">
      <h1 class="title text-center">How do I ask a question?</h1>
      <p class="paragraph text-center">
      Following these 3 steps, you will understand the very basics of how to ask homework questions privately and publicly. 
      </p>
    </div>
    <div class="col-4 phonecontainer">
      <img src="/images/phone1.svg" alt="" id="" srcset="" class="d-block mt-auto mx-auto">
      <p class="paragraph text-center">Make a picture of the assignment you're struggling with. 
     </p>
    </div>
    <div class="col-4 phonecontainer">
      <img src="/images/phone2.svg" alt="" id="" srcset="" class="d-block my-auto mx-auto">
      <p class="paragraph text-center">Make a picture of the assignment you're struggling with. 
     </p>
    </div>
    <div class="col-4 ">
      <img src="/images/phone3.svg" alt="" id="" srcset="" class="d-block mt-auto mx-auto">
      <p class="paragraph text-center">Make a picture of the assignment you're struggling with. 
     </p>
    </div>
  </div>




</div>
@endsection
