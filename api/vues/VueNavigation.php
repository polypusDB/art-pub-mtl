    <body>
        <header class="entete">
            <a href="/art-pub-mtl/api" class="logo"><img src="/art-pub-mtl/img/logoAPM.png" alt="Art Public Montreal"></a>
            <span class="flexgrow"></span>
            <div class="grandmenu">
                <div class="menuadmin">
                    <?php
                        if(!isset($_SESSION["utilisateur"])){
                        ?>
                        <a href="/art-pub-mtl/api/connection"><i class="fas fa-sign-in-alt"></i>Connexion</a>
                        <?php
                        }
                        else{
                            $username = $_SESSION["utilisateur"]["nom_connexion"];
                            $id = $_SESSION["utilisateur"]["id_usager"];
                            ?>
                            <a href="/art-pub-mtl/api/usager/<?=$id ?>" class="user"><i class="fas fa-grin-wink"></i>Salut <?php echo $username?></a>
                            <?php
                                if($_SESSION["utilisateur"]["type_acces"] == "admin"){
                                    ?>
                                        <a href="/art-pub-mtl/api/admin"><i class="fas fa-edit"></i>Tableau de Bord</a>
                                    <?php
                                }
                            ?>
                            
                            <a href="/art-pub-mtl/api/connection"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
                            <?php
                        }
                    ?>
                </div>
                <nav class="menu">
                    <!-- <span>
                        <a class="chercher" href=""><i class="fas fa-search"></i></a>
                        <input type="search" placeholder="Chercher">
                    </span> -->
                    
                    <a href="/art-pub-mtl/api"><i class="fas fa-home"></i>Accueil</a>
                    <a href="/art-pub-mtl/api/artiste"><i class="fas fa-paint-brush"></i>Artistes</a>
                    <a href="/art-pub-mtl/api/oeuvre"><i class="fas fa-brush"></i>Oeuvres</a>
                    <a href="/art-pub-mtl/api/parcours"><i class="fas fa-tree"></i>Parcours</a>
                    <a href="/art-pub-mtl/api/apropos"><i class="fas fa-spray-can"></i>À Propos</a>
                    <!-- <a href=""><i class="fas fa-comment"></i>Francais | English</a> -->
                </nav>
                <a href="#" class="menu-burger">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </header>

    