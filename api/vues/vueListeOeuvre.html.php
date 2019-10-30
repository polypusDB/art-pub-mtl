<template class="templateOeuvre">
	<div class="oeuvre carte">
		<div class="image dummy">
			<a href="oeuvre/{{id_oeuvre}}"><img src="{{image}}" alt="Art Public Montreal"></a>
		</div>
		<div class="texte">
			<h2 class="titre"><a href="oeuvre/{{id_oeuvre}}">{{titre}}</a></h2>
			<div class = "auteur Artiste{{id_oeuvre}}">
			</div>
		</div>
	</div>


</template >
		
<template class="templateAuteur">
	<a href="artiste/{{id_artiste}}">{{Nom}} {{NomCollectif}}</a>
</template>
<section class="contenu listeOeuvres">
	<div class="titreListe">
		<h1>Oeuvres</h1>
		<h4>Découvrez la grande collection</h4>
	</div>
	<p>Filtrer par :</p>
	<input type="text" class="recherche" placeholder="rechercher" value="" />
	<div class ="filtres">
		<div class="arrondissements">
			<h3 class="titreArron">Arrondissement</h3>
			 <div class ="filtresArr cacher">
			<?php
				 foreach($arrondissements as $arrondissement){
					 extract($arrondissement);
					 ?>
					 <div class ="unArrondissement" data-id="<?=$id_arrondissement ?>">
					 <label class= "arrondissement" ><input type="checkbox" class="check"/><?=$nom_arrondissement ?><span class="checkmark" data-id="<?=$id_arrondissement ?>"></span></label>
					 </div>
					 <?php
				 }
				 ?>
			</div>
		</div>
			<h3 class="titreCat">Categories</h3>
			<div class ="filtresCat cacher">
			<?php
	 			foreach($categories as $categorie){
				extract($categorie);
		 	?>
			 	<div class="uneCat">
					<label class= "categorie" data-id="<?=$id_categorie ?>"><input type="checkbox" class="check" /><?=$nom_francais ?><span class="checkmark" data-id="<?=$id_categorie ?>"></span></label>
			 	</div>
		 	<?php
	 			}
			 ?>
		</div>
	</div>
	<input type="button" value="filrer" class="btnFiltre"/>
			<!-- <h3>Filtre</h3>
			<ul> 	
			Section pour les filtres

		<?php
	 	//foreach($materiaux as $materiel){
			// extract($materiel);
		 ?>
		 	 <li class= "materiaux" data-id="<?//=$id_materiaux ?>"><?//=//$nom_francais ?></li> 
		 	<?php
	 //}
	 ?>
</ul> -->
			

	<div>
	<section class="oeuvres flex wrap parent">
		<?php
		foreach ($aData as $cle => $oeuvre) {
		extract($oeuvre);
		?>
			<div class="oeuvre carte">
				<div class="image dummy">
					<a href="oeuvre/<?=$id_oeuvre ?>"><img src="<?=$image ?>" alt="Art Public Montreal"></a>
				</div>
				<div class="texte">
					<h2 class="titre"><a href="oeuvre/<?=$id_oeuvre ?>"><?php echo $titre?></a></h2>
					<?php 
					foreach($Artistes as $artiste){
					extract($artiste);
					?>
						<div class="auteur">
							<a href="artiste/<?php echo $id_artiste ?>"><?php if($Nom != '' || $Prenom != '') { echo $Nom; } else { echo $NomCollectif; } ?></a>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		<?php
		}
		?>
	</section>
				
</section>
			
