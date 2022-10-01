<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../style/login.css" />
    </head>
    <body> 
        <nav>
            <a href="../index.php">Home</a>
            <a href="../navigation/impressum.html">Impressum</a>
            <a href="../navigation/faq.html">FAQ</a>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </nav>
        <form action="../index.php" method="post">
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password: </label><br>
            <input type="password" id="password" name="password"><br><br>
            <label for="checkbox1">Eingeloggt bleiben</label>
            <input type="checkbox" id="checkbox1" name="checkbox1" value="eingeloggt bleiben"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>