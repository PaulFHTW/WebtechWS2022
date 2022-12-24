<!DOCTYPE html>
<?php session_start();?>
<?php include_once 'dbaccess.php'; ?>
<?php 
    if(!isset($_SESSION['admin'])){
        header("Location: index.php");
    }
?>
<hmtl>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nutzer Verwaltung</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/profil.css" />
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>

<?php
    $reservierungErr = "KIeine Reservierungen!";?>

    <p class="greeting">Nutzer Konten & Reservierungen</p>
        <div class="container">
            <div class="row justify-content-start">
                    <div class="col-lg-4">
                        <p class="room-desc">Nutzer Konten</p>
                        <?php $sql = "SELECT * FROM user;";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                        <li class="desc">Nutzer ID: <?php echo $row['UID']; ?></li>
                        <li class="desc">Anrede: <?php echo $row['anrede']; ?></li>
                        <li class="desc">Vorname: <?php echo $row['vorname']; ?></li>
                        <li class="desc">Nachname: <?php echo $row['nachname']; ?></li>
                        <li class="desc">Nutzername: <?php echo $row['username']; ?></li>
                        <li class="desc">E-Mail: <?php echo $row['email']; ?></li>
                        <li class="desc">Status: <?php if($row['accountstatus'] == 0){ echo "Inaktiv";}else{echo "Aktiv";}?></li><br>
                        <p>-------------------------------------------------------</p>
                        <?php }?>
                        <a href="adminbearbeiten.php">
                            <div class="d-grid gap-2 col-lg-6 ">
                                <button class="btn btn-dark" type="button">Bearbeiten</button><br>
                            </div>
                        </a>
                    </div>

                <div class="col-lg-4">
                <p class="room-desc">Reservierungs Details</p>
                    <?php $sql = "SELECT * FROM reservierung JOIN user ON (FK_UID = UID);";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);?>
                    <?php if($num == 0){?>
                        <li class="desc" style="color: red"><?php echo $reservierungErr; ?></li>
                    <?php }?>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <?php
                        if($row['tier'] == 0){
                            $tier = "Nein";
                        }
                        if($row['tier'] == 1){
                            $tier = "Ja";
                        }

                        if($row['breakfast'] == 0){
                            $breakfast = "Nein";
                        }
                        if($row['breakfast'] == 1){
                            $breakfast = "Ja";
                        }
                    
                        if($row['parkplatz'] == 0){
                            $parkplatz = "Nein";
                        }
                        if($row['parkplatz'] == 1){
                            $parkplatz = "Ja";
                        }
                    ?>
                    <li class="desc">Reservierungs ID: <?php echo $row['RID']; ?></li>
                    <li class="desc">Nutzer ID: <?php echo $row['UID']; ?></li> 
                    <li class="desc">Nutzer: <?php echo $row['username']; ?></li>  
                    <li class="desc">Personen Anzahl: <?php echo $row['personen']; ?></li>
                    <li class="desc">Suite: <?php echo $row['suite']; ?></li>
                    <li class="desc">Ankunft: <?php echo $row['ankunft']; ?></li>
                    <li class="desc">Abreise: <?php echo $row['abreise']; ?></li>
                    <li class="desc">Haustier: <?php echo $tier; ?></li>
                    <li class="desc">Frühstück: <?php echo $breakfast; ?></li>
                    <li class="desc">Parkplatz: <?php echo $parkplatz; ?></li>
                    <li class="desc">Status: <?php echo $row['status']; ?></li>
                    <p>-------------------------------------------------------</p>
                    <?php }?>
                    <a href="adminreservierung.php">
                        <div class="d-grid gap-2 col-lg-6 ">
                            <button class="btn btn-dark" type="button">Bearbeiten</button><br>
                        </div>
                    </a>
                </div>
            </div>
        </div>

<?php include 'navigation/loginstatus.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</hmtl>