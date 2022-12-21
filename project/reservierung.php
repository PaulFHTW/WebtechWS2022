<?php session_start();?>
<?php include_once 'dbaccess.php'; ?>
<?php if(!isset($_SESSION['username'])){
    header("Location: register.php");
}?>
<!DOCTYPE html>
<hmtl lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Zimmer Reservierung </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/room.css"/>
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?><br><br>

    <p class="headline">Zimmer Reservierung</p>
<?php
    $personErr = false; $suiteErr = false; $ankunftErr = false; $abreiseErr = false; $roomErr = false;

    //Get User ID 
    $username = $_SESSION['username'];
    $var1 = "SELECT UID FROM user WHERE username='$username';";
    $var2 = mysqli_query($conn, $var1);
    $row = mysqli_fetch_assoc($var2);
    $UID = $row['UID'];
    
    $person = $_POST['person'];
    $suite = $_POST['suite'];
    $ankunft = $_POST['ankunft'];
    $abreise = $_POST['abreise'];
    $tier = $_POST['tier'];
    $breakfast = $_POST['breakfast'];
    $parkplatz = $_POST['parkplatz'];
    $status = "neu";

    if($person == "Personen Anzahl"){
        $personErr = "Bitte suchen Sie die Anzahl der Personen aus";
    }
    if($suite == "Suite"){
        $suiteErr = "Bitte suchen Sie eine Suite aus";
    }
    if(empty($ankunft)){
        $ankunftErr = "Bitte suchen Sie ein Ankunftsdatum aus";
    }
    if(empty($abreise)){
        $abreiseErr = "Bitte suchen Sie ein Abreisedatum aus";
    }
    if(empty($tier)){
        $tier = 0;
    }
    if(empty($parkplatz)){
        $parkplatz = 0;
    }
    if(empty($breakfast)){
        $breakfast = 0;
    }
    if(!empty($tier)){
        $tier = 1;
    }
    if(!empty($parkplatz)){
        $parkplatz = 1;
    }
    if(!empty($breakfast)){
        $breakfast = 1;
    }

    //Check if Suite is already booked on the arrival day
    $sql = "SELECT ankunft, suite FROM reservierung WHERE ankunft='$ankunft' AND suite='$suite';";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if($personErr == false && $suiteErr == false && $ankunftErr == false && $abreiseErr == false){
        if($num == 0){
        $sql = "INSERT INTO reservierung (tier, parkplatz, breakfast, personen, suite, ankunft, abreise, status, FK_UID) VALUES 
        ('$tier', '$parkplatz', '$breakfast', '$person', '$suite', '$ankunft', '$abreise', '$status', '$UID');";

        $result = mysqli_query($conn, $sql);

            if($result){
                $successText = "Reservierung erfolgreich";
            }
        }
        if($num > 0){
            $roomErr = "Diese Suite ist bereits verbucht";
        }
    }

    if($successText){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>'. $successText .'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($personErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $personErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($suiteErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $suiteErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    /*if($ankunftErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $ankunftErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if($abreiseErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $abreiseErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }*/

    if($roomErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $roomErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-4">
            <img src="images/room1.jpg" class="room-img">
                <p class="room-desc">Dreamer Deluxe Suite</p>
                <li class="desc">Kapazität des Zimmers: 2 - 4 Personen</li>
                <li class="desc">Zimmergröße 38 - 40 m2</li>
                <li class="desc">direkter Blick aufs Meer</li>
        </div>

        <div class="col-lg-4">
            <img src="images/room2.jpg" class="room-img"> 
                <p class="room-desc">Sunshine Deluxe Suite</p>
                <li class="desc">Kapazität des Zimmers: 2 - 4 Personen</li>
                <li class="desc">Zimmergröße 36 - 42 m2</li>
                <li class="desc">direkter Blick aufs Meer</li>
        </div>

        <div class="col-lg-4">
            <div class="room-form">
                <form action="<?php $_SERVER[" PHP_SELF "];?>" method="post">
                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="person">
                    <option selected>Personen Anzahl</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="suite">
                    <option selected>Suite</option>
                    <option value="Dreamer">Dreamer Deluxe Suite</option>
                    <option value="Sunshine">Sunshine Deluxe Suite</option>
                </select>
                    <label for="ankufnt">Ankunft: </label><br>
                    <input type="date" class="date" id="ankunft" name="ankunft"><br>
                    <label for="abreise">Abreise: </label><br>
                    <input type="date" class="date" id="abreise" name="abreise"><br><br>
                    <input type="checkbox" id="tier" name="tier" value="tier">
                    <label for="tier">Haustiere: </label><br>
                    <label for="tier">+ 150€</label><br><br>
                    <input type="checkbox" id="breakfast" name="breakfast" value="breakfast">
                    <label for="breakfast">Fruehstueck: </label><br>
                    <label for="breakfast">+ 50€ pro Person & Tag</label><br><br>
                    <input type="checkbox" id="parkplatz" name="parkplatz" value="parkplatz">
                    <label for="parkplatz">Parkplatz: </label><br>
                    <label for="parkplatz">+ 20€ pro Tag</label><br><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'navigation/loginstatus.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</hmtl>