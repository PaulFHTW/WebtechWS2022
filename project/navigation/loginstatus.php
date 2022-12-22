<!DOCTYPE html>
<html>
<div class="loginstatus">
<?php
session_start();
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];

if(isset($_SESSION['username'])){
    echo "Eingelogged als $username";
}
else if(isset($_SESSION['admin'])){
    echo "Eingelogged als $admin";
}
else{
    echo "Nicht eingelogged";
}

?>
</div>
</html>