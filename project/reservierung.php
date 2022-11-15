<!DOCTYPE html>
<?php session_start(); ?>
<hmtl lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Zimmer Reservierung </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/index.css" />
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>

    <?php if(isset($_SESSION["username"])){
            echo "Willkommen ".$_SESSION["username"];
        }
    ?>
    <br>
     
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Personen Anzahl
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">1</a>
            <a class="dropdown-item" href="#">2</a>
            <a class="dropdown-item" href="#">3</a>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</hmtl>