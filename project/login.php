<!DOCTYPE html>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/login.css" />
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>
    <div class="user-form">
        <form action="validation/login-validation.php" method="post">
            <p>Log In</p>
            <?php echo $nameErr;?>
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username"><br>
            <?php echo $passwdErr;?>
            <label for="password">Passwort: </label><br>
            <input type="password" id="password" name="password"><br><br>
            <label for="checkbox1">Eingeloggt bleiben</label>
            <input type="checkbox" id="checkbox1" name="checkbox1" value="eingeloggt bleiben"><br><br>
            <button type="submit" class="primary-btn">Submit</button>
        </form>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>    </body>
    </body>
</html>