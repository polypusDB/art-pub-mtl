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
	<div class="grandContRecherche">
		<p class="textFiltrer">Rechercher par :</p>
		<div class="contRecherche">
			<i class='fas fa-search'></i><input type="text" class="recherche" placeholder="Nom" value="" />
		</div>
	</div>
	<div class="grandContFiltres">
		<p class="textFiltrer">Filtrer par :</p>
		<div class ="filtres">
			<div class="contNomFiltre">
				<h3 class="titreArron">Arrondissement <i class="fas fa-angle-down"></i></h3>
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
			<div class="contNomFiltre">
				<h3 class="titreCat" >Categories <i class="fas fa-angle-down"></i></h3>
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
			<!-- Filtre pour les materiaux juste pour desktop -->
			<div class="contNomFiltre">
				<h3 class="titreMat">Materiaux <i class="fas fa-angle-down"></i></h3>
				<div class="filtresMat cacher">
					<?php
					foreach($materiaux as $materiel){
					extract($materiel);
					?>
					<div class="uneCat">
						<label class= "materiaux" data-id="<?=$id_materiaux ?>"><input type="checkbox" class="check" /><?=$nom_francais ?><span class="checkmark" data-id="<?=$id_materiaux ?>"></span></label>
					</div>
					<?php
					}
					?>
				</div>
			</div>	
		</div>
		<input type="button" value="filrer" class="btnFiltre"/>
	</div>
	
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
			
