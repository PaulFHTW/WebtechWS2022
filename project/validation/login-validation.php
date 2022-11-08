<?php
// define variables and set to empty values
$usernameErr = $emailErr = $passwordErr = "";
$username = $email = $password =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
    echo $nameErr ;
  } else {
    $username = test_input($_POST["username"]);
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
    echo $passwdErr;
  } else {
    $password = test_input($_POST["password"]);
  }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    echo "Logged in!";
    return $data;
}
?>