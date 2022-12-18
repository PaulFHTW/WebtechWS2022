<?php session_start();?>
<?php include_once 'dbaccess.php'; ?>
<?php 
    if(!isset($_SESSION['admin'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/news.css" />
    </head>
<body>
    <?php include 'navigation/navbar.php'?>

<?php 
    $emptyErr = false; $successText = false;

    $news = $_POST['news'];

    if(empty($news)){
        $emptyErr = "Please input Text";
    }
    else{
        $sql = "INSERT INTO news (text, date) VALUES ('$news', SYSDATE());";

        $result = mysqli_query($conn, $sql);     

        $successText = "News has been updated";
    }

    $sizeErr = false; $uploadErr = false; $filetypeErr = false; $successMsg = false;

        if(isset($_POST["submit"])){
            //var_dump($_FILES);
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
                        $fileNameNew = "pic1".".".$fileActualExt;
                        $fileDestination = "uploads/". $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $successMsg = "File uploaded successfully";
                    }else{
                        $sizeErr = "File size too big";
                    }
                }else{
                    $uploadErr = "Error uploading File";
                }
            }else{
                $filetypeErr = "Only jpg and png files are allowed";
            }
        }

        if($successMsg){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>'. $successMsg .'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if($successText){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>'. $successText .'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    
        if($sizeErr){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $sizeErr .' 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if($uploadErr){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $uploadErr .' 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        if($filetypeErr){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $filetypeErr .' 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="news-form">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <p>Important messages only:</p>
                <textarea id="news" name="news" rows="8" cols="50"></textarea><br><br>
                <p>Select image to upload:</p><br>
                <input type="file" name="file" id="file">
                <button type="submit" class="btn btn-primary" name="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</html>
