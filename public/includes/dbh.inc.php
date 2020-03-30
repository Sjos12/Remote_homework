<?php

$servername = "db";
$dbUsername = "homestead";
$dbPassword = "secret";
$dbName = "remote_homework_local";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn){
  die("Connection Failed: ".mysqli_connect_error());
}
