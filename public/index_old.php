<?php
//put this above every page that doesn't have the header
session_start();
require 'header.php'
?>

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
  <form action="includes/login.inc.php" method="post">
    <h3>Login</h3>

    <div class="form-group">
      <input type="text" class="shadow-sm form-control form-control-sm" name="mailuid" id="exampleInputEmail1" placeholder="Enter username">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <input type="password" class="shadow-sm form-control form-control-sm" name="pwd" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary" id="login-submit">Login</button>
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

