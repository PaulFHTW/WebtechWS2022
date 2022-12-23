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
    //get UID for logged in user
    $username = $_SESSION['username'];
    $var1 = "SELECT UID FROM user WHERE username='$username';";
    $var2 = mysqli_query($conn, $var1);
    $row = mysqli_fetch_assoc($var2);
    $UID = $row['UID'];

    $oldpasswordErr = false; $wrongpasswordErr = false; $newpasswordErr = false; $confnewpasswordErr = false; $notmatchingErr = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $confnewpassword = $_POST['confnewpassword'];

        if(empty($oldpassword)){
            $oldpasswordErr = "Bitte geben Sie ihr aktuelles Passwort ein";
        }
        if(empty($newpassword)){
            $newpasswordErr = "Bitte geben Sie ihr neues Passwort ein";
        }
        else{
            $newpassword = test_input($newpassword);
        }
        if(empty($confnewpassword)){
            $confnewpasswordErr = "Bitte wiederholen Sie ihr neues Passwort";
        }
        else{
            $confnewpassword = test_input($confnewpassword);
        }
        if($newpassword != $confnewpassword){
            $notmatchingErr = "Die neuen Passworte stimmen nicht überein";
        }

        $hash = password_hash($newpassword, PASSWORD_BCRYPT);

        if($oldpasswordErr == false && $newpasswordErr == false && $confnewpasswordErr == false && $notmatchingErr == false){
            $sql = "SELECT password FROM user WHERE username = '$username';";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
    
            if(password_verify($oldpassword, $row['password'])){
                $sql = "UPDATE user SET password = '$hash' WHERE UID = '$UID';";
                $result = mysqli_query($conn, $sql);
                $showAlert = true;
            }
            else{
                $wrongpasswordErr = "Aktuelles Passwort ist nicht richtig";
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
        <strong>Success!</strong>Ihr Passwort wurde erfolgreich geändert
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($oldpasswordErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $oldpasswordErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($wrongpasswordErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $wrongpasswordErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($newpasswordErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $newpasswordErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($confnewpasswordErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $confnewpasswordErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($notmatchingErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $notmatchingErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
?>
    
    <div class="user-form">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
            <p>Passwort ändern</p>
            <label for="oldpassword">Aktuelles Passwort: </label><br>
            <input type="password" id="oldpassword" name="oldpassword"><br>
            <label for="newpassword">Neues Passwort: </label><br>
            <input type="password" id="newpassword" name="newpassword"><br>
            <label for="password">Neues Passwort bestätigen: </label><br>
            <input type="password" id="confnewpassword" name="confnewpassword"><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php include 'navigation/loginstatus.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>