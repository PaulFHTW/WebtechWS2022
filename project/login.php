<!DOCTYPE html>
<?php session_start();?>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/login.css" />
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>
    <?php
        // define variables and set to empty values
        $usernameErr = $emailErr = $passwordErr = "";
        $username = $email = $password =  "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["username"])) {
                $usernameErr = "Username is required";?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $usernameErr;?>
                </div>
            <?php
            } else {
                $username = test_input($_POST["username"]);
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $passwordErr;?>
                </div>
            <?php
            } else {
                $password = test_input($_POST["password"]);
            }
            if($_POST["username"]== paul AND $_POST["password"]=="password"){
                $_SESSION["username"] = $_POST["username"];
                header("Location: reservierung.php");
            }
            if($_POST["username"]==="admin" AND $_POST["password"]==="admin"){
                $_SESSION["username"] = $_POST["username"];
                header("Location: admin.php");
            }
        }

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    
    <div class="user-form">
        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post">
            <p>Log In</p>
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Passwort: </label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="checkbox" id="checkbox1" name="checkbox1" value="eingeloggt bleiben">
            <label for="checkbox1">Eingeloggt bleiben</label><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>