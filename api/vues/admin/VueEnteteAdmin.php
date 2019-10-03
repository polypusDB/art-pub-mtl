<!DOCTYPE html>
    <html lang="fr">
    
    <head>
        <title>Admin - L'art public à Montréal</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        
        <link rel="stylesheet" href="/art-pub-mtl/css/adminmain.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/art-pub-mtl/css/entete-footer.css" type="text/css" media="screen">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">

        <script src="/art-pub-mtl/js/menu.js"></script>
        <!-- Code Fontawesome -->
    </head>
    
    <body>
    <header class="entete admin">
        <a href="/art-pub-mtl/api" class="logo"><img src="/art-pub-mtl/img/logoAPM.png" alt="Art Public Montreal"></a>
        <span class="flexgrow"></span>
        <nav class="menu">
            <?php
            if(!isset($_SESSION["utilisateur"])){
            ?>
            <a href="/art-pub-mtl/api/connection"><i class="fas fa-sign-in-alt"></i>Connexion</a>
            <?php
            }
            else{
                $username = $_SESSION["utilisateur"]["nom_connexion"];
                ?>
                <a href="#"><i class="fas fa-grin-wink"></i><?php echo $username?></a>
                <a href="/art-pub-mtl/api/connection"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
                <?php
            }
            ?>
            
        </nav>
        <a href="#" class="menu-burger">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times"></i>
        </a>
    </header>
    <div class="container">