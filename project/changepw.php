<!DOCTYPE html>
<?php session_start();?>
<?php include_once 'dbaccess.php';?>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Passwort ändern</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/login.css" />
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>
<?php

    $usernameErr = false; $passwordErr = false; $exists = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username)){
            $usernameErr = "Username erforderlich";
        }
        else{
            $username = test_input($username);
        }
        
        if(empty($password)){
            $passwordErr = "Passwort erforderlich";
        }
        else{
            $password = test_input($password);
        }

        if($usernameErr == false && $passwordErr == false){
            $sql = "SELECT username, password FROM administrator WHERE username = '$username' AND password = '$password';";

            $result = mysqli_query($conn, $sql);

            $num = mysqli_num_rows($result);

            if($num > 0){
                $_SESSION['admin'] = "admin";
                header("Location: news.php");
            }

            if($num == 0){
                $exists = "Falscher Username oder Passwort";
            }

        }
    }
    
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data; 
    }

    if($usernameErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $usernameErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($passwordErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $passwordErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($exists){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $exists .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
?>
    
    <div class="user-form">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
            <p>Passwort ändern</p>
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Passwort: </label><br>
            <input type="password" id="password" name="password"><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php include 'navigation/loginstatus.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>