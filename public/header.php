<?php
//put this above every page that doesn't have the header
  session_start();
 ?>

<html>
  <head>
    <title>Website</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Remote Homework</a>

      <div class="navbar-nav">
          <a class="nav-item nav-link active" href="#">Welcome</a>
          <a class="nav-item nav-link" href="#">About us</a>
          <a class="nav-item nav-link" href="#">Contact</a>
      </div>
      <form class="form-inline" action="includes/login.inc.php" method="post">
        <div class="form-row">
        </div>
      </form>
    </nav>
        <form action="includes/login.inc.php" method="post">
          <input class="form-control" type="text" name="mailuid" placeholder="Username/E-mail...">
          <input class="form-control" type="password" name="pwd" placeholder="Password">
          <button type="submit" name="login-submit">Login</button>
        </form>


          <a href="signup.php">signup</a>

        <form action="includes/logout.inc.php">
          <button type="submit" name="logout-submit">Logout</button>
        </form>


      </div>

      <h1>Hello!</h1>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>

<html>
