<section class="contenu listeOeuvres">
	<div class="titreListe">
		<h1>Oeuvres</h1>
		<h4>Découvrez la grande collection</h4>
	</div>
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
					<div class="boutons">
						<a href="oeuvre/sup/<?=$id_oeuvre ?>">Supprimer</a>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</section>
				
</section>
			
