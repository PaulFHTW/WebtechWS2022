<?php session_start();?>
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


        
    <div class="room-form">
        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post">
        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="person">
            <option selected>Personen Anzahl</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

            <label for="ankufnt">Ankunft: </label><br>
            <input type="text" id="ankunft" name="ankunft"><br>
            <label for="abreise">Abreise: </label><br>
            <input type="text" id="abreise" name="abreise"><br><br>

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