<!DOCTYPE html>
<html>
<div class="loginstatus">
<?php
session_start();
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];

if(isset($_SESSION['username'])){
    echo "Logged in as $username";
}
else if(isset($_SESSION['admin'])){
    echo "Logged in as $admin";
}
else{
    echo "Not logged in";
}

?>
</div>
</html>