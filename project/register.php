<!DOCTYPE html>
<?php session_start();?>
<?php include_once 'dbaccess.php';?>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/login.css" />
    </head>
    <body> 
    <?php include "navigation/navbar.php"; ?>
<?php 
    $usernameErr = false; $emailErr = false; $passwordErr = false; $confpasswordErr = false; $showAlert = false; $exists = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password =  $_POST['password'];
        $confpassword = $_POST['confirmpassword'];

        if (empty($username)) {
            $usernameErr = "Username is required";
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($email)) {
            $emailErr = "Email is required";  
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($password)) {
            $passwordErr = "Password is required";   
        } else {
            $password = test_input($_POST["password"]);
        }

        if($password != $confpassword){
            $confpasswordErr = "Passwords do not match";  
        }else{
            $confpassword = test_input($_POST["confirmpassword"]);
        }


        $sql = "SELECT * FROM user WHERE username = '$username';";

        $result = mysqli_query($conn, $sql);
    
        $num = mysqli_num_rows($result);
    
        if($usernameErr == false && $emailErr == false && $passwordErr == false && $confpasswordErr == false){
            if($num == 0){
                $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password');";
        
                $result = mysqli_query($conn, $sql);
        
                if($result){
                    $showAlert = true;
                }
                else{
                    $showError = true;
                }    
            }
            if($num > 0){
                $exists = "Username not available";
            }
        }
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data; 
    }

    if($showAlert){
        echo '<div class="alert alert-success alert-dismissable fade show" role="alert">
        <strong>Success!</strong> Your account was created and you can now login.
        </div>';
    }

    if($usernameErr){
        echo '<div class="alert alert-danger alert-dismissable fade show" role="alert">
        <strong>Error!</strong> '. $usernameErr .'
        </div>';
    }
    if($emailErr){
        echo '<div class="alert alert-danger alert-dismissable fade show" role="alert">
        <strong>Error!</strong> '. $emailErr .'
        </div>';
    }
    if($passwordErr){
        echo '<div class="alert alert-danger alert-dismissable fade show" role="alert">
        <strong>Error!</strong> '.$passwordErr.'
        </div>';
    }
    if($confpasswordErr){
        echo '<div class="alert alert-danger alert-dismissable fade show" role="alert">
        <strong>Error!</strong> '.$confpasswordErr.'
        </div>';
    }
    if($exists){
        echo '<div class="alert alert-danger alert-dismissable fade show" role="alert">
        <strong>Error!</strong> '. $exists.'
        </div>';
    }

?>
    <div class="user-form">
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
            <p>Register</p>
            <label for="email">E-Mail: </label><br>
            <input type="email" id="email" name="email"><br>
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Passwort: </label><br>
            <input type="password" id="password" name="password"><br>
            <label for="confirmpassword" id="confirmpassword" name="confirmpassword">Passwort bestaetigen: </label><br>
            <input type="password" id="confirmpassword" name="confirmpassword"><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>