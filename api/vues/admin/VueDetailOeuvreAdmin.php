<section class="contenu uneOeuvre flex flex-col">
	<div class="retour">
		<i class="fas fa-arrow-circle-left"></i>
		<a href="/art-pub-mtl/api/oeuvre"> Retour à la liste  </a>
	</div>
	<div class="titreListe">
		<h1>Oeuvres</h1>
	</div>
	<section class="oeuvres">
		<?php
		if(!empty($aData)){
			extract($aData);
		?>
			
			<div class="img-page dummy">
				<img src="/art-pub-mtl/img/placeholder_640_480.jpg" alt="Art Public Montreal">
				<h2 class="titre"><?php echo $titre?></h2>
			</div>
			<div class="texte">
				<h4>Artiste(s)</h4>
					<?php
						foreach($Artistes as $Artiste){
							extract($Artiste);
					?>	
						<a href="/art-pub-mtl/api/artiste/<?php echo $id_artiste ?>"> 
							<?php echo $nomA."<br>";?>
						</a>
					<?php 
						}
					?>
				<h4>Description</h4>
				<p><?php echo $description?></p>
				<h4>Dimension</h4>
				<p><?php echo $dimension?></p>
				<h4>Categorie</h4>
				<p><?php echo $NomCategorie?></p>
				<h4>Support</h4>
				<p><?php echo $NomSupport?></p>
				<h4>Endroit</h4>
				<p><?php echo $adresse?></p>
				<p><?php echo $NomArrondissement?></p>
		<?php
		}
		?>
			</div>
			
	</section>
</section>