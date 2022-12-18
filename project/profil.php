<!DOCTYPE html>
<?php session_start();?>
<?php include_once 'dbaccess.php';?>
<hmtl>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/index.css" />
    </head>
    <body>
<?php include 'navigation/navbar.php'; ?>

<?php
    $username = $_SESSION['username'];

    $sql = "SELECT username, personen, suite, ankunft, abreise, tier, breakfast, parkplatz, status FROM user JOIN reservierung ON (UID = FK_UID);";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['username'];
    echo $row['personen'];
    echo $row['suite'];
    echo $row['ankunft'];
    echo $row['abreise'];
    echo $row['tier'];
    echo $row['breakfast'];
    echo $row['parkplatz'];
    echo $row['status'];

?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</hmtl>