<?php session_start();?>
<?php include_once 'dbaccess.php'; ?>
<!DOCTYPE html>
<hmtl lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Zimmer Reservierung </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/room.css"/>
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>
<?php
    $personErr = false; $suiteErr = false; $ankunftErr = false; $abreiseErr = false; $roomErr = false;

    $person = $_POST['person'];
    $suite = $_POST['suite'];
    $ankunft = $_POST['ankunft'];
    $abreise = $_POST['abreise'];
    $tier = $_POST['tier'];
    $breakfast = $_POST['breakfast'];
    $parking = $_POST['parking'];
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

    $sql = "SELECT ankunft, suite FROM reservierung WHERE ankunft='$ankunft' AND suite='$suite';";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if($personErr == false && $suiteErr == false && $ankunftErr == false && $abreiseErr == false){
        if($num == 0){
        $sql = "INSERT INTO reservierung (personen, suite, ankunft, abreise, status) VALUES ('$person', '$suite', '$ankunft', '$abreise', '$status');";

        $result = mysqli_query($conn, $sql);

            if($result){
                $successText = "Reservierung erfolgreich";
            }
        }
        if($num > 0){
            $roomErr = "This Suite is already booked";
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

    if($ankunftErr){
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
    }

    if($roomErr){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $roomErr .' 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
?>
        
    <div class="room-form">
        <form action="<?php $_SERVER[" PHP_SELF "];?>" method="post">
        <p>Zimmer Reservierung</p>
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
            <input class="date" type="date" id="ankunft" name="ankunft"><br>
            <label for="abreise">Abreise: </label><br>
            <input class ="date" type="date" id="abreise" name="abreise"><br><br>

            <label for="haustiere">Haustiere : </label><br>
            <input type="checkbox" id="tier" name="tier" value="tier">
            <label for="haustiere">+ $150</label><br><br>

            <label for="all-inclusive">Fruehstueck : </label><br>
            <input type="checkbox" id="breakfast" name="breakfast" value="breakfast">
            <label for="all-inclusive">+ $50 pro Person & Tag</label><br><br>

            <label for="all-inclusive">Parkplatz : </label><br>
            <input type="checkbox" id="parking" name="parking" value="parking">
            <label for="all-inclusive">+ $20 pro Tag</label><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</hmtl>