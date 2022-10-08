<!DOCTYPE html>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../style/login.css" />
    </head>
    <body> 
        <nav>
            <li><a href="../index.php">Home</a>
            <li><a href="../navigation/impressum.html">Impressum</a>
            <li><a href="../navigation/faq.html">FAQ</a>
            <li><a href="register.php">Register</a>
            <li><a href="login.php">Login</a>
        </nav>
        <form action="../index.php" method="post">
            <p>Log In</p>
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Passwort: </label><br>
            <input type="password" id="password" name="password"><br><br>
            <label for="checkbox1">Eingeloggt bleiben</label>
            <input type="checkbox" id="checkbox1" name="checkbox1" value="eingeloggt bleiben"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>