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
    $anredeErr = false; $vornameErr = false; $nachnameErr = false;
    $usernameErr = false; $emailErr = false; $passwordErr = false; $confpasswordErr = false; $showAlert = false; $exists = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $anrede = $_POST['anrede'];
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password =  $_POST['password'];
        $confpassword = $_POST['confirmpassword'];
        $status = "1";

        if (empty($anrede)) {
            $anredeErr = "Anrede ist erforderlich";
        } else {
            $anrede = test_input($_POST["anrede"]);
        }

        if (empty($vorname)) {
            $vornameErr = "Vorname ist erforderlich";
        } else {
            $vorname = test_input($_POST["vorname"]);
        }

        if (empty($nachname)) {
            $nachnameErr = "Nachname ist erforderlich";
        } else {
            $nachname = test_input($_POST["nachname"]);
        }

        if (empty($username)) {
            $usernameErr = "Username ist erforderlich";
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($email)) {
            $emailErr = "Email ist erforderlich";  
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($password)) {
            $passwordErr = "Passwort ist erforderlich";   
        } else {
            $password = test_input($_POST["password"]);
        }

        if($password != $confpassword){
            $confpasswordErr = "Passworte sind nicht gleich";  
        }else{
            $confpassword = test_input($_POST["confirmpassword"]);
        }

        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        //check if username already exists
        $sql = "SELECT * FROM user WHERE username = '$username';";

        $result = mysqli_query($conn, $sql);
    
        $num = mysqli_num_rows($result);
    
        if($anredeErr == false && $vornameErr == false && $nachnameErr == false && $usernameErr == false && $emailErr == false && $passwordErr == false && $confpasswordErr == false){
            if($num == 0){
                $sql = "INSERT INTO user (anrede, vorname, nachname, username, email, password, status) VALUES ('$anrede', '$vorname', '$nachname', '$username', '$email', '$hash', '$status');";
        
                $result = mysqli_query($conn, $sql);
        
                if($result){
                    $showAlert = true;
                }
                else{
                    $showError = true;
                }    
            }
            if($num > 0){
                $exists = "Username nicht verfügbar";
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
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>Ihr Konto wurde erfolgreich angelegt
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($anredeErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $anredeErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($vornameErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $vornameErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($nachnameErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $nachnameErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($usernameErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $usernameErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($emailErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $emailErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($passwordErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $passwordErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($confpasswordErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $confpasswordErr .' 
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
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
            <p>Registrierung</p>
            <label for="anrede">Anrede: </label><br>
            <input type="text" id="anrede" name="anrede"><br>
            <label for="vorname">Vorname: </label><br>
            <input type="text" id="vorname" name="vorname"><br>
            <label for="nachname">Nachname: </label><br>
            <input type="text" id="nachname" name="nachname"><br>
            <label for="email">E-Mail: </label><br>
            <input type="email" id="email" name="email"><br>
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Passwort: </label><br>
            <input type="password" id="password" name="password"><br>
            <label for="confirmpassword" id="confirmpassword" name="confirmpassword">Passwort bestaetigen: </label><br>
            <input type="password" id="confirmpassword" name="confirmpassword"><br><br>
            <a href="login.php">Sie haben bereits ein Kundenkonto</a><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php include 'navigation/loginstatus.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>