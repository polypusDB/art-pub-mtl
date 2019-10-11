 <section class="contenu listeArtiste">
     <div class="titreListe">
     <?php if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"]){
            ?>
        <div class="boutons bt-jaune">
            <a href="/art-pub-mtl/api/artiste/ajouter">Ajouter un artiste</a>
        </div>
        <?php 
		}
        ?>
            <h1>Artistes</h1>
            <h4>Les acteurs d'Art Public Montréal</h4>
        </div>
    <section class="oeuvres flex wrap">
        <?php
        foreach ($aData as $cle => $artiste) {
            extract($artiste);
        ?>       
        <section class="artiste-carte">
            <div class="rectangle"></div>
				<header class="">
				    <a href="artiste/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $nom_collectif; } ?></h2></a> 
				</header>
        </section>
				<?php
					}
				?>
     </section>
</section>


			