@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="container" id="content1">
  <div class="startpage">
    <h3>Homework just got a lot easier</h3>
    <p>Remote homework is an online tool that makes collaborating remotely on a project easy. </p>
  </div>
  <div class="wrapper">
    <a href="{{ route('info') }}" class="shadow-sm btn btn-primary btn-md">Get Started</a>
  </div>
</div>

<hr>

<div class="container" id="content2">
  <h3>How does it work?</h3>
  <p class="col-xs-6">The idea of our tool is to make it easier to help with blablabla homework if your child has a question. Then you upload it onto our website. You can then send it to another user. Then you can both work live on the document by placing draggable boxes with audiofiles, videos, or text. </p>
  <img src="phone-template.png" alt="phone" class="col-xs-6" id="iphoneimage">
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
@endsection
