<section class="contenu listeOeuvres">
	<div class="titreListe">
		<h1>Oeuvres</h1>
	</div>
		<section class="oeuvres flex wrap">
			<?php
			if(!empty($aData)){
				// var_dump($aData);
				
				extract($aData);
				// var_dump($Artistes);
				foreach($Artistes as $Artiste){
					extract($Artiste);
				
					echo $nomA;
				}
				extract($Artiste);
			foreach ($aData as $cle => $oeuvre) {
			// extract($oeuvre);
			
			echo "<br/>";
			// var_dump($oeuvre);
			?>
				<!-- <div class="oeuvre carte">
					<div class="image dummy">
						<img src="../../img/placeholder_640_480.jpg" alt="Art Public Montreal">
					</div>
					<div class="texte">
						<h2 class="titre"><?php echo $titre?></h2>
						<h4>Artiste</h4>
						<p>Lorem ipsum</p>
						<h4>Description</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in odio laoreet, bibendum neque at, pharetra quam. Nunc ac pulvinar dolor. Duis malesuada sapien et viverra fermentum. Duis interdum mi id tempus iaculis. Pellentesque at lectus mollis, accumsan sapien eu, malesuada tellus.</p>
						<h4>Dimension</h4>
						<p>100x100</p>
						<h4>Categorie</h4>
						<p>Consectetur adipiscing</p>
						<h4>Support</h4>
						<p>Proin in odio laoreet</p>
						<h4>Endroit</h4>
						<p>Bibendum neque</p> -->
			<?php
			}
			}
			?>
					</div>
				</div>
		</section>
</section>