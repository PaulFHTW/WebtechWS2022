<!DOCTYPE html>
<?php session_start();?>
<?php if(!isset($_SESSION['username'])){
        header("Location: login.php");
        }?>
<?php include_once 'dbaccess.php';?>
<hmtl>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/profil.css" />
    </head>
    <body>
<?php include 'navigation/navbar.php'; ?>

<?php
    $reservierungErr = false;
    $username = $_SESSION['username'];
    $var1 = "SELECT UID FROM user WHERE username='$username';";
    $var2 = mysqli_query($conn, $var1);
    $row = mysqli_fetch_assoc($var2);
    $UID = $row['UID'];

    $sql = "SELECT username, email FROM user WHERE UID = $UID;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $accountname = $row['username'];
    $email = $row['email'];

    $sql = "SELECT personen, suite, ankunft, abreise, tier, breakfast, parkplatz, status FROM reservierung WHERE FK_UID = $UID;";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num > 0){
        $row = mysqli_fetch_assoc($result);
        $anzahl = $row['personen'];
        $suite = $row['suite'];
        $ankunft = $row['ankunft'];
        $abreise = $row['abreise'];
        $tier = $row['tier'];
        if($tier == NULL){
            $tier = "Nein";
        }
        if($tier != NULL){
            $tier = "Ja";
        }
        $breakfast = $row['breakfast'];
        if($breakfast == NULL){
            $breakfast = "Nein";
        }
        if($breakfast != NULL){
            $breakfast = "Ja";
        }
        $parkplatz = $row['parkplatz'];
        if($parkplatz == NULL){
            $parkplatz = "Nein";
        }
        if($parkplatz != NULL){
            $parkplatz = "Ja";
        }
        $status = $row['status'];
    }
    else{
        $reservierungErr = "Sie haben noch keine Reservierungen!";
    }


?>

<div class="container">
    <div class="row justify-content-start">
    <p class="greeting">Reservierung & Konto</p>
                <div class="col-lg-4">
                    <p class="room-desc">Konto informationen</p>
                    <li class="desc">Nutzername: <?php echo $accountname; ?></li>
                    <li class="desc">E-Mail: <?php echo $email; ?></li>
    
                    <p class="room-desc">Reservierungs Details</p>
                    <?php if($num == 0){?>
                        <li class="desc" style="color: red"><?php echo $reservierungErr; ?></li>
                    <?php }?>
                    <?php if($num > 0) { ?>
                    <li class="desc">Personen Anzahl: <?php echo $anzahl; ?></li>
                    <li class="desc">Suite: <?php echo $suite; ?></li>
                    <li class="desc">Ankunft: <?php echo $ankunft; ?></li>
                    <li class="desc">Abreise: <?php echo $abreise; ?></li>
                    <li class="desc">Haustier: <?php echo $tier; ?></li>
                    <li class="desc">Fruehstueck: <?php echo $breakfast; ?></li>
                    <li class="desc">Parkplatz: <?php echo $parkplatz; ?></li>
                    <li class="desc">Status: <?php echo $status; ?></li>
                    <?php }?>
                </div>
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</hmtl>