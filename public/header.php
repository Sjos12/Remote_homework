<?php
    $username = $_SESSION['userUid'] ?? null;
?>

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


            <div class="username_greeting">
                <hr class="linebreak">
                <!-- Will only display if user is logged in -->
                <?php if($username) : ?>
                    <p>Hello, <?php echo $username; ?>!</p>
                    <a href="includes/logout.inc.php">Logout</a>
                <?php else: ?>
                    <a href="#content3" >Login</a>
                <?php endif; ?>

            </div>
        </ul>
    </div>

</nav>
</body>
</html>
