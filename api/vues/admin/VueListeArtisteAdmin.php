<template class="listeArtiste">
            <tr>
                <td><input type="checkbox" name="checks[]" value="{{id_artiste}}"></td>
                <td> <a href="/art-pub-mtl/api/artisteAdmin/mod/{{id_artiste}}"><h2 class="nom">{{nom}} {{prenom}} {{nom_collectif}}</h2></a></td>
                <td><a class="btnMod" href="/art-pub-mtl/api/artisteAdmin/mod/{{id_artiste}}"><i class="fas fa-pencil-alt"></i></a></td>
                <td><a class="btnSup" href="/art-pub-mtl/api/artisteAdmin/sup/{{id_artiste}}"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
    </template>
<div class="contenu listeArtiste">
    <div class="titreListe">
        <h1 id="ancre">Liste des Artistes</h1>
    </div>
    <section>



        <input type= "text" class = "adminSearchArtiste"/><input type="button" class = "btnRecherche" value = "chercher">
        <form action="" method="POST">
            <div class="bts-principal">
				<div class="bt-ajouter">
					<a href="/art-pub-mtl/api/artisteAdmin/ajouter"><i class="fas fa-plus-circle"></i></a>
				</div>
				<div class="bt-supprimer">
					<input type="submit" name="suppArt" value="" />
				</div>
			</div>
			<?php
				if(isset($msgErreur)){
					echo "<div class='msg-erreur'>" . $msgErreur . "</div>";
				}
			?>
            <table class="table parent">
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
                    <td><input type="checkbox" name="checks[]" value="<?=$id_artiste ?>"></td>
                    <td> <a href="/art-pub-mtl/api/artisteAdmin/mod/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $nom_collectif; } ?></h2></a></td>
                    <td><a class="btnMod" href="/art-pub-mtl/api/artisteAdmin/mod/<?=$id_artiste ?>"><i class="fas fa-pencil-alt"></i></a></td>
                    <td><a class="btnSup" href="/art-pub-mtl/api/artisteAdmin/sup/<?=$id_artiste ?>"><i class="fas fa-trash-alt"></i></a></td>  
                </tr>
            <?php
                }
            ?>
            </table>
            <a href="#ancre">Remonter</a>
            <div class="bts-principal">
				<div class="bt-ajouter">
					<a href="/art-pub-mtl/api/artisteAdmin/ajouter"><i class="fas fa-plus-circle"></i></a>
				</div>
				<div class="bt-supprimer">
					<input type="submit" name="suppArt" value="" />
				</div>
			</div>
        </form>
    </section>
    <?php
        include "VuePiedAdmin.php";
    ?>
</div>


			