@extends('layouts.app')

@section('content')
<div data-spy="scroll" data-target="#navbar" data-offset="0">
  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="container" id="content1">
      <div class="row startpage">
        <!-- the div that holds the text from content1-->
        <div class='col-lg-7 col-sm-12' id="content1"> 
          <h2>Homework just got a lot easier</h2>
          <p>Remote homework is an online tool that makes collaborating remotely on projects or homework a piece of cake. </p>
          <div class="wrapper">
              <a href="{{ route('login') }}" class="shadow-sm btn btn-primary btn-md border border-info">Get Started</a>
              <a href="#content2" class="shadow-sm btn btn-white btn-md border border-info">Contact us here</a>
          </div>
        </div>
        <!-- Apple mac that is displayed on content1 -->
        <img src="mac_transparant.png" id='mac' class='col-lg-4 col-sm-12'>
      </div>
  </div>

<hr>

<div class="container">
  <div class="row" id="content2">
    <!-- header of content2 -->
    <h2 class="col-12" id="content2_header">What we offer</h2>
    <!-- items in content2 -->
    <div class="col-lg-4">
      <h4>Easy collaboration</h4>
      <p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable</p>
    </div>
    
    <div class="col-lg-4">
      <h4>Workspace</h4>
      <p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable</p>
    </div>

    <div class="col-lg-4">
      <h4>Low cost subscriptions</h4>
      <p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable</p>
    </div>
    
    <!--<img src="phone-template.png" alt="phone" class="col-xs-8" id="iphoneimage">-->
  </div>
</div>
<hr>
<div class="container">
  <div class="row" id="content2">
    <!-- header of content2 -->
    <h2 class="col-12" id="content2_header">How does it work? </h2>
    <!-- items in content2 -->
    <div class="col-lg-4">
      <h4>Step 1 </h4>
      <p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable</p>
    </div>
    
    <div class="col-lg-4">
      <h4>Step 2 </h4>
      <p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable</p>
    </div>

    <div class="col-lg-4">
      <h4>Step 3</h4>
      <p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable</p>
    </div>
    
    <!--<img src="phone-template.png" alt="phone" class="col-xs-8" id="iphoneimage">-->
  </div>
</div>
<hr>

                      <!-- checks if user is logged in -->
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      You are logged in!
          </div>
      </div>
  </div>
</div>
@endsection
