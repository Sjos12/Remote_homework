<!DOCTYPE html>
<html lang="en">
<head>
  <title>Remote Homework - HOME</title>
  <!-- Insert your adress bar icon here -->
  <LINK REL="SHORTCUT ICON"
       HREF="top-icon.ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50" id="content1">
    <!-- Grey with black text -->
    <nav class="navbar sticky-top navbar-expand-sm bg-white navbar-light ">
        <a class="navbar-brand" href="#">
            <img src="Better_logo.png" alt="Logo" style="width:105px;">
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#data"><span class="navbar-toggler-icon" style="width:20px; height: 25px;"></span></button>

        <div class="collapse navbar-collapse" id="data">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="#content1">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#content2">Info</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#content3">Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#content4">Signup</a>
                </li>
            </ul>
        </div> 
    </nav>
  
<div class="container" id="content1">
  <div class="startpage">
    <h3>Homework just got a lot easier</h3>
    <p>Remote homework is an online tool that makes collaborating remotely on a project easy. </p>
  </div>
  <div class="wrapper">
    <a href="#content3" class="shadow-sm btn btn-primary btn-md">Get Started</a> 
  </div>
</div>

<hr>

<div class="container" id="content2">
  <h3>How does it work?</h3>
  <p class="col-xs-6">The idea of our tool is to make it easier to help with blablabla homework if your child has a question. Then you upload it onto our website. You can then send it to another user. Then you can both work live on the document by placing draggable boxes with audiofiles, videos, or text. </p>
  <img src="phone-template.png" alt="phone" class="col-xs-6">
</div>

<hr>

<div class="container" id="content3">
  <form>
    <h3>Login</h3>

    <div class="form-group">
      <input type="email" class="shadow-sm form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <input type="password" class="shadow-sm form-control form-control-sm" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary" id="submitbutton">Login</button>
  </form>
</div>

<hr>

<div class="container" id="content4">
  <form>
    <h3>Signup</h3>

    <div class="form-group">
      <input type="email" class="shadow-sm form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <input type="password" class="shadow-sm form-control form-control-sm" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary" id="submitbutton">Login</button>
  </form>
</div>
</body>
</html>

<?php
  require 'footer.php' 
?>

