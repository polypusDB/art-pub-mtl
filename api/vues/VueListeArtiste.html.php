<section class="contenu listeArtiste">
            <section class="oeuvres-flex-wrap">
			<?php if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"]){
		?>
			<a href="/art-pub-mtl/api/artiste/ajouter">Ajouter un artiste</a>
			<?php 
				}
				foreach ($aData as $cle => $artiste) {
						extract($artiste);
						?>
				<section class="artiste-carte">
				<header class="">
				<a href="artiste/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $nom_collectif; } ?></h2></a> 
				</header>
				<?php
					if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				?>
				<div class="boutons">
				<a class="btnSup" href="/art-pub-mtl/api/artiste/sup/<?=$id_artiste ?>">Supprimer</a>
				</div>
				<?php
					}
				?>
				</section>
				<?php
					}
				?>
				</section>
			</section>
			