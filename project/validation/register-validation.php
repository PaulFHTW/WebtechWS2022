<!DOCTYPE hmtl>
<html lang="de">
<body>

<?php
$username = $password = $email = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = test_input($POST["email"]);
    $username = test_input($POST["username"]);
    $password = test_input($POST["password"]);
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
}
?>

Registered successfully!


</body>
</html>