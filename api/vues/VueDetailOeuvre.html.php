<section class="contenu uneOeuvre flex flex-col">
			<!-- a enlever plus tard -->
			<style>
				.map{
					height: 400px;  /* The height is 400 pixels */
        			width: 100%;  /* The width is the width of the web page */
				}
			</style>
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
				<p class = "longitude"><?php echo $longitude?></p>
				<p class = "latitude"><?php echo $latitude?></p>
		<?php
		}
		?>
			</div>
			<div class = "map">
				
			</div>
			<script>
				function initMap() {
  						// The location of Uluru
						  let long = document.querySelector(".longitude").innerHTML;
						  let lati = document.querySelector(".latitude").innerHTML;
						  long = parseFloat(long);
						  lati = parseFloat(lati);
  						var uluru = {lat: lati, lng: long};
  						// The map, centered at Uluru
  						var map = new google.maps.Map(
      					document.querySelector('.map'), {zoom: 15, center: uluru}); // rajouter le style pour la carte ici comme ceci : ({zoom: 15, center: uluru , RAJOUTER LA BALISE STYLE ICI});)
  						// The marker, positioned at Uluru
  						var marker = new google.maps.Marker({position: uluru, map: map});
				}
			</script>
			    <!-- <script async defer
    				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXx618pZgGovbT1ZNDB7y22Ulx9-4CLqs&callback=initMap">
    			</script> -->

	</section>
</section>