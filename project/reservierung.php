<!DOCTYPE html>
<?php session_start(); ?>
<hmtl lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Zimmer Reservierung </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/room.css"/>
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container-fluid">
                <img src="images/room1.jpg" class="d-block w-100" alt="First" height="800">
            </div>
        </div>
        <div class="carousel-item">
            <div class="container-fluid">
                <img src="images/room2.jpg" class="d-block w-100" alt="Second" height="800">
            </div>
        </div>
        <div class="carousel-item">
            <div class="container-fluid">
                <img src="images/room3.jpg" class="d-block w-100" alt="Third" height="800">
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div><br>

    <?php
        // define variables and set to empty values
        $number = $nights = "";
        $numberErr = $nightsErr = "";

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST["person"] == "Personen Anzahl"){
                $personErr = "Anzahl der Besucher zu gering";?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $personErr;?>
                </div>
            <?php    
            }else{
                $person = test_input($_POST["person"]);
            }?>
            <?php
            if($_POST["nights"] == "Nächte"){
                $nightsErr = "Anzahl der Nächte zu gering";?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $nightsErr;?>
                </div>
            <?php    
            }else{
                $nights = test_input($_POST["person"]);
            }
        }

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    <?php
    $successMsg = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["person"] != "Personen Anzahl" && $_POST["nights"] != "Nächte"){
            $successMsg = "Buchung erfolgreich";?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMsg;?>
            </div>
        <?php
        }
    }
    ?>

        
    <br><h4 style="text-align: center;">Zimmer Reservierung</h4>

    <div class="greeting">
        <?php if(isset($_SESSION["username"])){
                echo "Willkommen ".$_SESSION["username"];
            }
        ?>
    </div>
        
    <div class="room-form">
        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post">
        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="person">
            <option selected>Personen Anzahl</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <select class="form-select form-select-md" aria-label=".form-select-sm example" name="nights">
            <option selected>Nächte</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select><br>

            <label for="haustiere">Haustiere : </label><br>
            <input type="checkbox" id="ja" name="ja" value="ja">
            <label for="haustiere">Ja</label><br>
            <input type="checkbox" id="nein" name="nein" value="nein">
            <label for="haustiere">Nein</label><br><br>

            <label for="all-inclusive">All-inclusive : </label><br>
            <input type="checkbox" id="ja" name="ja" value="ja">
            <label for="all-inclusive">Ja</label><br>
            <input type="checkbox" id="nein" name="nein" value="nein">
            <label for="all-inclusive">Nein</label><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</hmtl>