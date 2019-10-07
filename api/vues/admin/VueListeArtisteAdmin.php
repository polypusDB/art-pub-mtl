<div class="contenu listeArtiste">
    <div class="titreListe">
        <h1>Artistes</h1>
        <?php if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"]){
            ?>
            <div class="bt-ajouter">
                <a href="/art-pub-mtl/api/artisteAdmin/ajouter">Ajouter un artiste</a>
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
                <th>Titre</th>
                <th>Editer</th>
            </tr>
            </thead>
        <?php
        foreach ($aData as $cle => $artiste) {
            extract($artiste);
        ?>      
            <tr>
                <td>
                    <input type="checkbox" name="" value="">
                </td>
                <td>  
                    <a href="artistes/mod/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $nom_collectif; } ?></h2></a>    
                </td>
                <td>
                    <a class="btnSup" href="/art-pub-mtl/api/artisteAdmin/sup/<?=$id_artiste ?>">Supprimer</a>
                    <a class="btnMod" href="/art-pub-mtl/api/artisteAdmin/mod/<?=$id_artiste ?>">Modifier</a>
                </td>
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
</div>


			