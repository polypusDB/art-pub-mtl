<div class="contenu listeOeuvres">
	<div class="titreListe">
		<h1>Oeuvres</h1>
		<?php if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"]){
			?>
			<div class="bts-principal">
                <div class="bt-ajouter">
                    <a href="/art-pub-mtl/api/oeuvreAdmin/ajouter"><i class="fas fa-plus-circle"></i></a>
                </div>
                <div class="bt-supprimer">
                    <a href="/art-pub-mtl/api/oeuvreAdmin/sup/"><i class="fas fa-trash-alt"></i></a>
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
                <th>Titre</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
		<?php
		foreach ($aData as $cle => $oeuvre) {
			extract($oeuvre);
		?>
			<tr>
                <td><input type="checkbox" name="" value=""></td>
                <td><h2 class="titre"><a href="/art-pub-mtl/api/oeuvreAdmin/mod/<?=$id_oeuvre ?>"><?php echo $titre?></a></h2></td>
                <td><a class="btnMod" href="/art-pub-mtl/api/oeuvreAdmin/mod/<?=$id_oeuvre ?>"><i class="fas fa-pencil-alt"></i></a></td>
				<td><a class="btnSup" href="/art-pub-mtl/api/oeuvreAdmin/sup/<?=$id_oeuvre ?>"><i class="fas fa-trash-alt"></i></a></td>
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
			
