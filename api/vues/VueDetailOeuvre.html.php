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
		<div class="dummy">
			<img src="<?=$image ?>" alt="Art Public Montreal">
			<h5>
				<span><?php echo $titre . " : "?></span>
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
			</h5>
		</div>
		<div class="texte">
			<h2 class="titre"><?php echo $titre?></h2>
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
			<ul>
				<li>
					<h4>Dimension</h4>
					<p><?php echo $dimension?></p>
				</li>
				<li>
					<h4>Categorie</h4>
					<p><?php echo $NomCategorie?></p>
				</li>
				<li>
					<h4>Support</h4>
					<p><?php echo $NomSupport?></p>
				</li>
				<li>
					<h4>Endroit</h4>
					<p><?php echo $adresse?></p>
					<p><?php echo $NomArrondissement?></p>
					<p class = "longitude"><?php echo $longitude?></p>
					<p class = "latitude"><?php echo $latitude?></p>
				</li>
				<li>
					<h4>Description</h4>
					<p><?php echo $description?></p>
				</li>
			</ul>
		</div>
	</section>
	<div class="form-comment">
		<h2>Commentaires</h2>
		<div class ="list-comment">
			<?php
				foreach($commentaires as $commentaire){
					extract($commentaire);
					if(isset($_SESSION["utilisateur"])){
						$userConnect = $_SESSION["utilisateur"]["nom_connexion"];
					}
					else{
						$userConnect = "";
					}
					
					?>
						<div data-idCommentaire="<?=$id_commentaire ?>" class="unCommentaire">
							<p><?=$nom_connexion ?></p>
							<p><?=$texte ?></p>
							<p data-idcommentairesig="<?=$id_commentaire ?>" class="signaler<?php if($signaler ==1){ echo " signalerON"; } ?>"><i class="fab fa-font-awesome-flag" data-signaler ="true" data-idcommentairesig="<?=$id_commentaire ?>"></i></p>
							<?php
								if($userConnect == $nom_connexion){
								?>
									<p data-idcommentairesup="<?=$id_commentaire ?>"class="suprimer"><i class="fas fa-trash" data-supprimer ="true" ></i></p>
								<?php
								}
							?>
						</div>
				<?php
				}
			}
			?>
		</div>
		<div class="titreComment">Laisse ton commentaire ou tes questions ici!</div>
		<div>
			<?php
				if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["nom_connexion"] != ""){
					?>
					<input type="text" class="commentaire" placeholder ="Commentez ici!" name ="commentaire"/>
					<input type="hidden" class="idOeuvre" name ="id_oeuvre" value = "<?=$id_oeuvre ?>"/>
					<input type="hidden" class="idUser" name ="id_user" value="<?=$_SESSION["utilisateur"]["id_usager"] ?>"/>
					<input type="hidden" class="user" name ="user" value="<?=$_SESSION["utilisateur"]["nom_connexion"] ?>"/>
					<input type="button" value ="Commentez" class="btnCom"/>
					<?php
				}else{
					?>
					<input type="text" class="commentaire" placeholder ="Vous devez être connecter pour commenter" name ="commentaire"/>
					<input type="button" value ="Commentez" class="btnCom" disabled = true/>
					<?php
				}
			?>
		</div>
	</div>
	<div class = "map"></div>


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