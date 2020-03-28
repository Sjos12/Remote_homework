 <?php
//checks if client actually clicked submit button
if (isset($_POST['login-submit'])) {
  //includes dbh.inc.php script
  require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];
  //checks if the login form is filled in, if not it displays error
  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else{
    $sql = "SELECT * FROM users WHERE uidUser=? OR emailUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        //verifies password from login form with that from database
        $pwdcheck = password_verify($password, $row['pwdUsers']);

        if ($pwdcheck == false){
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        //gets executed if the login credentials are correct
        elseif ($pwdcheck == true){
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUid'] = $row['uidUser'];
          header("Location: ../dashboard.php?error=login=success");
          exit();
        }
        else {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }
  }

}
else {
  header("Location: ../index.php");
  exit();
}
