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
	</div>
	<section class="oeuvres flex wrap">
		<?php
		foreach ($aData as $cle => $oeuvre) {
		extract($oeuvre);
		?>
			<div class="oeuvre carte">
				<div class="image dummy">
					<!-- <a href="oeuvre/<?=$id_oeuvre ?>"><img src="../img/placeholder_640_480.jpg" alt="Art Public Montreal"></a> -->
				</div>
				<div class="texte">
					<h2 class="titre"><a href="/art-pub-mtl/api/oeuvreAdmin/mod/<?=$id_oeuvre ?>"><?php echo $titre?></a></h2>
					<?php
					if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
					?>
						<div class="boutons bt-blue">
							<a class="btnSup" href="/art-pub-mtl/api/oeuvreAdmin/sup/<?=$id_oeuvre ?>">Supprimer</a>
						</div>
						<div class="boutons bt-blue">
							<a class="btnMod" href="/art-pub-mtl/api/oeuvreAdmin/mod/<?=$id_oeuvre ?>">Modifier</a>
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
			
