<!DOCTYPE hmtl>
<html lang="de">
<body>

<?php
$username = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = test_input($POST["username"]);
    $password = test_input($POST["password"]);
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
}
?>

Login successful!


</body>
</html>