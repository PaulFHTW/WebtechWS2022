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
        <link rel="stylesheet" type="text/css" href="style/room.css" />
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>

<?php 
    $RIDERR = false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //get reservation ID
    $RID = $_POST['RID'];
    //get data for specified RID
    $sql = "SELECT * FROM reservierung WHERE RID = '$RID';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    //old reservation details
    $personen = $row['personen'];
    $suite = $row['suite'];
    $ankunft = $row['ankunft'];
    $abreise = $row['abreise'];
    $tier = $row['tier'];
    $breakfast = $row['breakfast'];
    $parkplatz = $row['parkplatz'];
    $status = $row['status'];
    //new reservation details
    $newpersonen = $_POST['personen'];
    $newsuite = $_POST['suite'];
    $newankunft = $_POST['ankunft'];
    $newnabreise = $_POST['abreise'];
    $newtier = $_POST['tier'];
    $newbreakfast = $_POST['breakfast'];
    $newparkplatz = $_POST['parkplatz'];
    $newstatus = $_POST['status'];

    if(empty($RID)){
        $RIDERR = "Reservierungs ID erforderlich!";
    }
    else{
        $showAlert = true;
    }

    if ($newpersonen == "Personen Anzahl"){
        $newpersonen = $personen;
    } else {
        $newpersonen = $_POST['personen'];
    }

    if ($newsuite == "Suite"){
        $newsuite = $suite;
    } else {
        $newsutie = $_POST['suite'];
    }

    if (empty($newankunft)) {
        $newankunft = $ankunft;
    } else {
        $newankunft = $_POST['ankunft'];
    }

    if (empty($newabreise)) {
        $newabreise = $abreise;
    } else {
        $newabreise = $_POST['abreise'];
    }

    if (empty($newtier)) {
        $newtier = 0;  
    } else {
        $newtier = 1;
    }

    if (empty($newbreakfast)) {
        $newbreakfast = 0;  
    } else {
        $newbreakfast = 1;
    }

    if (empty($newparkplatz)) {
        $newparkplatz = 0;  
    } else {
        $newparkplatz = 1;
    }

    if ($newstatus == "Status") {
        $newstatus = $status;  
    }

    if ($newstatus == "Neu") {
        $newstatus = "Neu";  
    }

    if($newstatus == "Bestätigt"){
        $newstatus = "Bestätigt";
    }

    if($newstatus == "Storniert"){
        $newstatus = "Storniert";
    }


            $sql = "UPDATE reservierung SET personen = '$newpersonen' WHERE RID = '$RID';";
            $result = mysqli_query($conn, $sql);
            
            $sql = "UPDATE reservierung SET suite = '$newsuite' WHERE RID = '$RID';";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE reservierung SET ankunft = '$newankunft' WHERE RID = '$RID';";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE reservierung SET abreise = '$newabreise' WHERE RID = '$RID';";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE reservierung SET tier = '$newtier' WHERE RID = '$RID';";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE reservierung SET breakfast = '$newbreakfast' WHERE RID = '$RID';";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE reservierung SET parkplatz = '$newparkplatz' WHERE RID = '$RID';";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE reservierung SET status = '$newstatus' WHERE RID = '$RID';";
            $result = mysqli_query($conn, $sql);
    
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data; 
}

if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>Reservierung wurde erfolgreich geändert
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

if($RIDERR){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '. $RIDERR .' 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

?>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-4">
            <div class="room-form">
                <form action="<?php $_SERVER[" PHP_SELF "];?>" method="post">
                <p>Reservierungen bearbeiten</p>
                <label for="RID">Reservierungs ID: </label><br>
                <input type="number" id="RID" name="RID"><br><br>
                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="personen">
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
                    <label for="ankunft">Ankunft: </label><br>
                    <input type="date" class="date" id="ankunft" name="ankunft"><br>
                    <label for="abreise">Abreise: </label><br>
                    <input type="date" class="date" id="abreise" name="abreise"><br><br>
                    <input type="checkbox" id="tier" name="tier" value="tier">
                    <label for="tier">Haustiere: </label><br>
                    <label for="tier">+ 150€</label><br><br>
                    <input type="checkbox" id="breakfast" name="breakfast" value="breakfast">
                    <label for="breakfast">Frühstück: </label><br>
                    <label for="breakfast">+ 50€ pro Person & Tag</label><br><br>
                    <input type="checkbox" id="parkplatz" name="parkplatz" value="parkplatz">
                    <label for="parkplatz">Parkplatz: </label><br>
                    <label for="parkplatz">+ 20€ pro Tag</label><br><br>
                    <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="status">
                        <option selected>Status</option>
                        <option value="Neu">Neu</option>
                        <option value="Bestätigt">Bestätigt</option>
                        <option value="Storniert">Storniert</option>
                    </select>
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