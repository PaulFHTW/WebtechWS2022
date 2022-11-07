<?php
// define variables and set to empty values
$nameErr = $emailErr = $passwdErr = "";
$username = $email = $password =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $nameErr = "Username is required";
    echo $nameErr ;
  } else {
    $username = test_input($_POST["username"]);
  }

  if (empty($_POST["password"])) {
    $passwdErr = "Password is required";
    echo $passwdErr;
  } else {
    $password = test_input($_POST["password"]);
  }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>