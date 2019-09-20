<div class="titreListe">
    <h1>Artistes</h1>
    <h4>Les acteurs d'Art Public Montréal</h4>
</div>    
<section class="contenu listeArtiste">
    <section class="artiste-flex-wrap">
        <?php
            foreach ($aData as $cle => $artiste) {
                    extract($artiste);
        ?>
        <section class="artiste-carte">
            <header class="">
                <div class="rectangle"></div>
			     <a href="artiste/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $NomCollectif; } ?></h2></a> 
            </header>
            <?php
                if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
                    ?>
                    <div class="boutons">
                        <a class="btnSup" href="oeuvre/sup/<?=$id_artiste?>">Supprimer</a>
                    </div>
                    <?php
                }
            ?>
            </section>
                <?php
            }
        ?>
    </section>
</section>
			