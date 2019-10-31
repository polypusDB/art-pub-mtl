<template class="listeOeuvre">
	<tr>
		<td><label><input type="checkbox" name="checks[]" value="{{id_oeuvre}}"></label></td>
		<td><h2 class="titre"><a href="/art-pub-mtl/api/oeuvreAdmin/mod/{{id_oeuvre}}">{{titre}}</a></h2></td>
		<td><a class="btnMod" href="/art-pub-mtl/api/oeuvreAdmin/mod/{{id_oeuvre}}"><i class="fas fa-pencil-alt"></i></a></td>
		<td><a class="btnSup" href="/art-pub-mtl/api/oeuvreAdmin/sup/{{id_oeuvre}}"><i class="fas fa-trash-alt"></i></a></td>
	</tr>
</template>

<div class="contenu listeOeuvres">
	<div class="titreListe">
		<h1 id="ancre">Liste des Oeuvres</h1>
	</div>
	<section>
	<input type= "text" class = "adminSearchOeuvre"/><input type="button" class = "btnRecherche" value = "chercher">

		<form action="" method="POST">
			<div class="bts-principal">
				<div class="bt-ajouter">
					<a href="/art-pub-mtl/api/oeuvreAdmin/ajouter"><i class="fas fa-plus-circle"></i></a>
				</div>
				<div class="bt-supprimer">
					<input type="submit" name="supp" value="" />
				</div>
			</div>
			<div class="fond MessageOeuvre">
				<div class="contenuMessage">
					<p class = "texte">Êtes-vous certains de vouloir supprimer ce(s) élément(s)</p>
					<div class= "btnOptions">
						<p class="non">NON</p>
						<p class="oui">OUI</p>
					</div>
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
					<td><label><input type="checkbox" name="checks[]" value="<?=$id_oeuvre ?>"></label></td>
					<td><h2 class="titre"><a href="/art-pub-mtl/api/oeuvreAdmin/mod/<?=$id_oeuvre ?>"><?php echo $titre?></a></h2></td>
					<td><a class="btnMod" href="/art-pub-mtl/api/oeuvreAdmin/mod/<?=$id_oeuvre ?>"><i class="fas fa-pencil-alt"></i></a></td>
					<td><a class="btnSup" ><i class="fas fa-trash-alt" data-id="<?=$id_oeuvre ?>"></i></a></td>
				</tr>
			<?php
			// href="/art-pub-mtl/api/oeuvreAdmin/sup/
			}
			?>
			</table>
			<a href="#ancre">Remonter</a>
			<div class="bts-principal">
				<div class="bt-ajouter">
					<a href="/art-pub-mtl/api/oeuvreAdmin/ajouter"><i class="fas fa-plus-circle"></i></a>
				</div>
				<div class="bt-supprimer">
					<input type="submit" name="supp" value="" />
				</div>
			</div>
		</form>
	</section>
	<?php
        include "VuePiedAdmin.php";
    ?>
</div>
			
