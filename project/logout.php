<?php session_start();?>

<?php 
    if(isset($_SESSION["username"])){
        session_destroy();
        echo "Logged out!";
    }
    else{
        echo "You are not logged in!";
    }
    header("Location: index.php");
?>