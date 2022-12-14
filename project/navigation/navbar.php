<?php session_start(); ?>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="house logo">
                Habbo Hotel
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-toggle="expand" data-bs-target="#navbarNav" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <?php if(!isset($_SESSION['username']) && !isset($_SESSION['admin'])){?>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <?php }?>
            <?php if(isset($_SESSION['username']) && !isset($_SESSION['admin'])){?>
                <li class="nav-item">
                    <a class="nav-link" href="reservierung.php">Reservierung</a>
                </li> 
            <?php }?>
            <?php if(isset($_SESSION['username']) && !isset($_SESSION['admin'])){?>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li> 
            <?php }?>
            <?php if(isset($_SESSION['admin'])){?>
                <li class="nav-item">
                    <a class="nav-link" href="news.php">News</a>
                </li> 
            <?php }?>
            <?php if(isset($_SESSION['admin'])){?>
                <li class="nav-item">
                    <a class="nav-link" href="verwaltung.php">Verwaltung</a>
                </li> 
            <?php }?>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="faq.php">FAQ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="impressum.php">Impressum</a>
            </li>
            <?php if(isset($_SESSION["username"]) || isset($_SESSION["admin"])){?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <?php }?>
        </ul>
        </div>
        </div>
    </nav>