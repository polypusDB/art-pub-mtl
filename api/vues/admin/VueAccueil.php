<div class="contenu">
        <h1>Bienvenue <span>
        <?php
            echo $_SESSION["utilisateur"]["nom_connexion"];
        ?> 
        </span>
        à ton Tableau de Bord!
        </h1>
        <div class="home-info">
            <div class="infoIco"></div>
            <div class="infoTexte">
                <h2>Mon Information</h2>
                <p>
                <?php
                    echo $_SESSION["utilisateur"]["prenom"];
                    echo " ";
                    echo $_SESSION["utilisateur"]["nom"];
                ?>
                </p>
                <p>
                <?php
                    echo $_SESSION["utilisateur"]["courriel"];
                ?>
                </p>
            </div>
            <a href="">
                <div class="infobt">Voir mon profil</div>
            </a>
        </div>
        <div class="home-cont">
            <section>
                <h3>Dernières Oeuvres</h3>
                <div class="table-accueil">
                    <table class="table">
                    <?php
                    foreach ($aDataOeu as $cle => $oeuvre) {
                        extract($oeuvre);
                    ?>
                        <tr>
                            <td>
                                <h2 class="titre"><a href="/art-pub-mtl/api/oeuvreAdmin/mod/<?=$id_oeuvre ?>"><?php echo $titre?></a></h2>
                            </td>
                            <td>
                            <a class="btnMod" href="/art-pub-mtl/api/oeuvreAdmin/mod/<?=$id_oeuvre ?>"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </table>
                </div>
            </section>
            <section>
                <h3>Derniers Artistes</h3>
                <div class="table-accueil">
                    <table class="table">
                    <?php
                    foreach ($aDataArt as $cle => $artiste) {
                        extract($artiste);
                    ?> 
                        <tr>
                            <td>
                                <a href="/art-pub-mtl/api/artisteAdmin/mod/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $nom_collectif; } ?></h2></a>    
                            </td>
                            <td>
                            <a class="btnMod" href="/art-pub-mtl/api/artisteAdmin/mod/<?=$id_artiste ?>"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                    </table>
                </div>
            </section>
            
            <!-- <section>
                <h3><a href="">Parcours</a></h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Titre</td>
                            <td>Categorie</td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>Nom</td>
                        </tr>
                    </table>
                </div>
            </section> -->
        </div>
       



             
        
    <?php
        include "VuePiedAdmin.php";
    ?>
    </div>
    
</div>


