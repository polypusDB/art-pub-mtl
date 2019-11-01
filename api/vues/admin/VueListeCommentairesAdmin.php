<div class="contenu listeOeuvres">
	<div class="titreListe">
		<h1 id="ancre">Liste des Commentaires</h1>
	</div>
	<section>
	<form action="" method="POST">
			<?php
            if($aData != "vide"){
                ?>
                <table class="table parent">
				<thead>
				<tr>
                    <th></th>
					<th>Texte</th>
					<th>Auteur</th>
					<th>Approuver</th>
					<th>Supprimer</th>
				</tr>
				</thead>
                <?php
                    foreach ($aData as $cle => $com) {
                        extract($com);
                ?>
                <tr>
					<td><label><input type="checkbox" name="checks[]" value="<?=$id_commentaire ?>"></label></td>
					<td><h2 class="titre"><a href="#"><?php echo $texte?></a></h2></td>
					<td><h2 class="titre"><a href="#"><?php echo $nom_connexion?></a></h2></td>
					<td><a class="btnMod" href="/art-pub-mtl/api/commentaireAdmin/app/<?=$id_commentaire ?>"><i class="fas fa-check"></i></i></a></td>
					<td><a class="btnSup" href="/art-pub-mtl/api/commentaireAdmin/sup/<?=$id_commentaire ?>"><i class="fas fa-trash-alt"></i></a></td>
				</tr>
                <?php
                }
            }
            else{
                ?>
                <p>Aucun commentaires n'ont été signalés</p>
                <?php
            }
			?>
			</table>
			<a href="#ancre">Remonter</a>
			<div class="bts-principal">
				<div class="bt-supprimer">
					<input type="submit" name="sup" value="" />
				</div>
				<div class="bt-approuver">
					<input type="submit" name="app" value="" />
				</div>
			</div>
		</form>
	</section>
	<?php
        include "VuePiedAdmin.php";
    ?>
</div>
			
