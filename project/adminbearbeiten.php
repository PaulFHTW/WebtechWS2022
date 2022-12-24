<!DOCTYPE html>
<?php session_start();?>
<?php if(!isset($_SESSION['admin'])){
            header("Location: index.php");
        }?>
<?php include_once 'dbaccess.php';?>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bearbeiten</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/login.css" />
    </head>
    <body> 
    <?php include "navigation/navbar.php"; ?>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $UID = $_POST['UID'];
        //get data for specified UID
        $sql = "SELECT * FROM user WHERE UID = '$UID';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $anrede = $row['anrede'];
        $vorname = $row['vorname'];
        $nachname = $row['nachname'];
        $accountname = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        $status = $row['accountstatus'];

        $newanrede = $_POST['anrede'];
        $newvorname = $_POST['vorname'];
        $newnachname = $_POST['nachname'];
        $newusername = $_POST['username'];
        $newemail = $_POST['email'];
        $newpassword = $_POST['password'];
        $newstatus = $_POST['status'];

        if (empty($newanrede)) {
            $newanrede = $anrede;
        } else {
            $newanrede = test_input($_POST["anrede"]);
        }

        if (empty($newvorname)) {
            $newvorname = $vorname;
        } else {
            $newvorname = test_input($_POST["vorname"]);
        }

        if (empty($newnachname)) {
            $newnachname = $nachname;
        } else {
            $newnachname = test_input($_POST["nachname"]);
        }

        if (empty($newusername)) {
            $newusername = $accountname;
        } else {
            $newusername = test_input($_POST["username"]);
        }

        if (empty($newemail)) {
            $newemail = $email;  
        } else {
            $newemail = test_input($_POST["email"]);
        }

        if (empty($newpassword)) {
            $newpassword = $password;  
        } else {
            $newpassword = test_input($_POST["email"]);
        }

        if ($status == "Status") {
            $newstatus = $status;  
        }

        if($newstatus == "Aktiv"){
            $newstatus = 1;
        }

        if($newstatus == "Inaktiv"){
            $newstatus = 0;
        }

        //check if username already exists
        $sql = "SELECT * FROM user WHERE username = '$newusername';";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
    

            if($num == 0 || $num == 1){
                $sql = "UPDATE user SET anrede = '$newanrede' WHERE UID = '$UID';";
                $result = mysqli_query($conn, $sql);
                
                $sql = "UPDATE user SET vorname = '$newvorname' WHERE UID = '$UID';";
                $result = mysqli_query($conn, $sql);

                $sql = "UPDATE user SET nachname = '$newnachname' WHERE UID = '$UID';";
                $result = mysqli_query($conn, $sql);

                $sql = "UPDATE user SET username = '$newusername' WHERE UID = '$UID';";
                $result = mysqli_query($conn, $sql);

                $sql = "UPDATE user SET email = '$newemail' WHERE UID = '$UID';";
                $result = mysqli_query($conn, $sql);

                $sql = "UPDATE user SET password = '$newpassword' WHERE UID = '$UID';";
                $result = mysqli_query($conn, $sql);
                
                $sql = "UPDATE user SET accountstatus = '$newstatus' WHERE UID = '$UID';";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $showAlert = true;
                }
      
            }
            if($num > 1){
                $exists = "Username nicht verfügbar";
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
        <strong>Success!</strong>Kontodaten wurden erfolgreich geändert
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
            <p>Nutzerdaten bearbeiten</p>
            <label for="UID">Nutzer ID: </label><br>
            <input type="number" id="UID" name="UID" placeholder="Nutzer ID"><br><br>
            <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="status">
                <option selected>Status</option>
                <option value="1">Aktiv</option>
                <option value="0">Inaktiv</option>
            </select>
            <label for="anrede">Anrede: </label><br>
            <input type="text" id="anrede" name="anrede" placeholder="Neue Anrede"><br>
            <label for="vorname">Vorname: </label><br>
            <input type="text" id="vorname" name="vorname" placeholder="Neuer Vorname"><br>
            <label for="nachname">Nachname: </label><br>
            <input type="text" id="nachname" name="nachname" placeholder="Neuer Nachname"><br>
            <label for="username">Username: </label><br>
            <input type="text" id="username" name="username" placeholder="Neuer Username"><br>
            <label for="email">E-Mail: </label><br>
            <input type="email" id="email" name="email" placeholder="Neue Email"><br>
            <label for="email">Passwort: </label><br>
            <input type="password" id="password" name="password" placeholder="Neues Passwort"><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php include 'navigation/loginstatus.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>