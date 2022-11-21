<!DOCTYPE html>
<?php session_start(); 
    if($_SESSION["username"]==="admin"){
        
    }else{
        header("Location: login.php");
    }
?>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/room.css" />
    </head>
<body>
    <?php include 'navigation/navbar.php'?>
<div class="room-form">
    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
    <p>Select image to upload:</p><br>
    <input type="file" name="file" id="file">
    <button type="submit" class="btn btn-primary" name="submit">Upload</button>
    </form>
</div>

</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</html>

    <?php
        if(isset($_POST["submit"])){
            var_dump($_FILES);
            $file = $_FILES["file"];
            $fileName = $_FILES["file"]["name"];
            $fileTmpName = $_FILES["file"]["tmp_name"];
            $fileSize = $_FILES["file"]["size"];
            $fileError = $_FILES["file"]["error"];
            $fileType = $_FILES["file"]["type"];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 15000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = "uploads/".$fileNameNew;
                        move_uploaded_file($fileTmpName, $$fileDestination);
                        echo '<span style=color:green>File uploaded successfully</span>';
                    }else{
                        echo '<span style=color:red>File size too big</span>';
                    }
                }else{
                    echo '<span style=color:red>Error uploading File</span>';
                }
            }else{
                echo '<span style=color:red>Only images files allowed</span>';
            }
        }
    ?>