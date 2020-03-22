<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

if (!isset($_POST['signup-submit'])) {
  header("Location: ../signup.php");
  exit();
}

require 'dbh.inc.php';

$username = $_POST['uid'];
$email = $_POST['mail'];
$password = $_POST['pwd'];
$passwordconfirmation = $_POST['pwd-repeat'];

if (empty($username) || empty($email) || empty($password) || empty($passwordconfirmation)) {
  header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
  exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9] * $/", $username)) {
  header("Location: ../signup.php?error=invalidmailuid");
  exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header("Location: ../signup.php?error=invalidmail&uid=".$username);
  exit();
}

if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
  header("Location: ../signup.php?error=invaliduid&mail=".$email);
  exit();
}

if ($password !== $passwordconfirmation ) {
  header("Location: ../signup.php?error=passwordcheckuid=".$username."&mail=".$email);
  exit();
}

$sql = "SELECT uidUser FROM users WHERE uidUser=?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
  var_dump(mysqli_connect_error());
  die('foo');
  header("Location: ../signup.php?error=sqlerror");
  exit();
}

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$resultCheck = mysqli_stmt_num_rows($stmt);

if($resultCheck > 0 ){
  header("Location: ../signup.php?error=usertaken&mail=".$email);
  exit();
}

$sql = "INSERT INTO users (uidUser, emailUsers, pwdUsers) VALUES (?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
  die(mysqli_error($conn));
  header("Location: ../signup.php?error=sqlerror");
  exit();
}

$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
mysqli_stmt_execute($stmt);
header("Location: ../signup.php?signup=succes");

mysqli_stmt_close($stmt);
mysqli_close($conn);
