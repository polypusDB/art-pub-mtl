 <section class="contenu listeArtiste">
     <div class="titreListe">

            <h1>Artistes</h1>
            <h4>Les acteurs d'Art Public Montréal</h4>
        </div>
        <input type= "text" class = "searchArtiste"/><input type="button" class ="btnRecherche" value = "chercher">
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


			