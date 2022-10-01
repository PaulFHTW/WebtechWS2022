<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="../style/login.css" />
    </head>
    <body> 
        <nav>
            <div>
                <a href="../index.php">Home</a><br><br>
            </div>
        </nav>
        <form>
            <label for="email">E-Mail: </label><br>
            <input type="email" id="email" name="email"><br>
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Passwort: </label><br>
            <input type="password" id="password" name="password"><br>
            <label for="confirmpassword" id="confirmpassword" name="confirmpassword">Passwort bestaetigen: </label><br>
            <input type="password" id="confirmpassword" name="confirmpassword"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>