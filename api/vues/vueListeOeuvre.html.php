<section class="contenu listeOeuvres">
	<div class="titreListe">
	<?php if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"]){
		?>
		<!-- <div class="boutons bt-jaune"> -->
			<!-- <a href="/art-pub-mtl/api/oeuvre/ajouter">Ajouter une oeuvre</a> -->
		<!-- </div> -->
		<?php 
			}
		?>
		<h1>Oeuvres</h1>
		<h4>Découvrez la grande collection</h4>
	</div>

	<input type="text" class="recherche" placeholder="rechercher"/><input type="button" value="rechercher" />
	<div class ="filtres">
	
		<div class="arrondissements">
			<h3 class="titreArron">Arrondissement</h3>
			 <!--Section pour les filtres -->
			 <div class ="filtresArr">
			<?php
				 foreach($arrondissements as $arrondissement){
					 extract($arrondissement);
					 ?>
					 <div class ="unArrondissement">
					 <label class= "arrondissement" data-id="<?=$id_arrondissement ?>"><input type="checkbox"/><?=$nom_arrondissement ?><span class="checkmark" data-id="<?=$id_arrondissement ?>"></span></label>
					 </div>
					 <?php
				 }
				 ?>
			</div>
		</div>
	</div>
			<h3>Filtre</h3>
			<ul> 	
			<!--Section pour les filtres -->

		<?php
	 	foreach($materiaux as $materiel){
			extract($materiel);
		 ?>
		 	<li class= "materiaux" data-id="<?=$id_materiaux ?>"><?=$nom_francais ?></li>
		 	<?php
	 }
	 ?>
</ul>
			<h3>categories</h3>
			<ul> 	<!--Section pour les filtres -->

		<?php
	 	foreach($categories as $categorie){
			extract($categorie);
		 ?>
		 	<li class= "categorie" data-id="<?=$id_categorie ?>"><?=$nom_francais ?></li>
		 	<?php
	 }
	 ?>
</ul>
	<div>
	<section class="oeuvres flex wrap">
		<?php
		foreach ($aData as $cle => $oeuvre) {
		extract($oeuvre);
		?>
			<div class="oeuvre carte">
				<div class="image dummy">
					<a href="oeuvre/<?=$id_oeuvre ?>"><img src="../img/placeholder_640_480.jpg" alt="Art Public Montreal"></a>
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
			
