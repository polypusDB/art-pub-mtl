<!DOCTYPE html>
    <html lang="fr">
    
    <head>
        <title>Admin - L'art public à Montréal</title>
        <meta charset="UTF8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        
        <link rel="stylesheet" href="/art-pub-mtl/css/adminmain.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/art-pub-mtl/css/entete-footer.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/art-pub-mtl/css/formulaires.css" type="text/css" media="screen">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="/art-pub-mtl/css/webfonts/all.css" type="text/css" media="screen">

        <!-- scripts -->
        <script src="/art-pub-mtl/js/menuAdmin.js"></script>
    </head>
    
    <body>
    <header class="entete admin">
        <a href="/art-pub-mtl/api/admin" class="logo"><img src="/art-pub-mtl/img/logoAPM.png" alt="Art Public Montreal"></a>
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
                <a href="/art-pub-mtl/api/admin"><i class="fas fa-grin-wink"></i><?php echo $username?></a>
                <a href="/art-pub-mtl/api/connection"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
                <a href="/art-pub-mtl/api" target="_blank" ></i><i class="fas fa-home"></i></a>
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