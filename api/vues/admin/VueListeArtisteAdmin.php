<div class="contenu listeArtiste">
    <div class="titreListe">
        <h1>Liste des Artistes</h1>
        <?php if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"]){
            ?>
            <div class="bts-principal">
                <div class="bt-ajouter">
                    <a href="/art-pub-mtl/api/artisteAdmin/ajouter"><i class="fas fa-plus-circle"></i></a>
                </div>
                <div class="bt-supprimer">
                    <a href="/art-pub-mtl/api/artisteAdmin/sup/"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
        <?php 
		}
        ?>
    </div>
    <section>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
        <?php
        foreach ($aData as $cle => $artiste) {
            extract($artiste);
        ?>      
            <tr>
                <td><input type="checkbox" name="" value=""></td>
                <td> <a href="/art-pub-mtl/api/artisteAdmin/mod/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $nom_collectif; } ?></h2></a></td>
                <td><a class="btnMod" href="/art-pub-mtl/api/artisteAdmin/mod/<?=$id_artiste ?>"><i class="fas fa-pencil-alt"></i></a></td>
                <td><a class="btnSup" href="/art-pub-mtl/api/artisteAdmin/sup/<?=$id_artiste ?>"><i class="fas fa-trash-alt"></i></a></td>  
            </tr>
        <?php
            }
        ?>
        </table>
    </section>
    <?php
        include "VuePiedAdmin.php";
    ?>
</div>


			