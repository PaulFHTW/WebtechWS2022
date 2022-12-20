<!DOCTYPE html>
<?php session_start();?> 
<?php include_once 'dbaccess.php'; ?>
<html lang="de">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="style/index.css" />
    </head>
    <body>
    <?php include 'navigation/navbar.php'; ?>
    <div class="background">
        <div class="container-fluid">
            <img src="images/hotel.jpg" class="background-img" alt="beach-resort">
        </div>
    </div>
    <br>
        <p class="headline">Planen Sie Ihren Traumurlaub</p>
        <p>
        Moderne und luxuriös ausgestattete Zimmer und Suites mit geräumigen Balkonen.<br>
        Das Luxury Habbo Hotel verfügt über insgesamt 41 Zimmer, 3 Familienzimmer und 5 Suites. <br>
        Wählen Sie ein Zimmer oder eine Suite nach Ihrem Maß. <br>
        Gemütliche King Size Betten garantieren einen einzigartigen Urlaub. <br>
        Genießen Sie den wunderschönen Sonnenuntergang oder das abendliche Murmeln vom Balkon des eigenen Zimmers aus. <br>
        </p>
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-12">
                    <h4 class="news">News</h4>
                    <br>
                    <img src="uploads/pic1.png" class="img-thumbnail rounded float-end" alt="picture">
                    <?php
                        $sql = "SELECT * FROM news;";

                        $result = mysqli_query($conn, $sql);

                        $num = mysqli_num_rows($result);

                        if($num > 0){
                            while($row = mysqli_fetch_assoc($result)){?>
                            <li class="desc"><?php
                                echo $row['text']."<br>";
                            ?></li>
                            <?php
                            }
                        }
                    ?>
                    <br>
                </div>
            </div>
        </div>
                
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-6">
                <img src="images/room1.jpg" class="room-img">
                    <p class="room-desc">Dreamer Deluxe Suite</p>
                    <li class="desc">Kapazität des Zimmers: 2 - 4 Personen</li>
                    <li class="desc">Zimmergröße 38 - 40 m2</li>
                    <li class="desc">direkter Blick aufs Meer</li>
                    <div class="d-grid gap-2 col-6 mx-auto">
                    <?php if(isset($_SESSION['username'])){?>
                    <a href="reservierung.php"><?php }
                    else{ ?>
                    <a href="register.php"><?php }?>
                            <button class="btn btn-outline-primary" type="button">Jetzt buchen</button>
                        </a>
                    </a>
                    </div>
                    <br>
                </div>
                <div class="col-lg-6">
                <img src="images/room2.jpg" class="room-img"> 
                    <p class="room-desc">Sunshine Deluxe Suite</p>
                    <li class="desc">Kapazität des Zimmers: 2 - 4 Personen</li>
                    <li class="desc">Zimmergröße 36 - 42 m2</li>
                    <li class="desc">direkter Blick aufs Meer</li>
                    <div class="d-grid gap-2 col-6 mx-auto">
                    <?php if(isset($_SESSION['username'])){?>
                    <a href="reservierung.php"><?php }
                    else{ ?>
                    <a href="register.php"><?php }?>
                            <button class="btn btn-outline-primary" type="button">Jetzt buchen</button>
                        </a>
                    </a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <br>
        <br>
                
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</html>