 <template class="liste_Artiste">
    <section class="artiste-carte">
        <div class="rectangle"></div>
        <header class="">
            <a href="artiste/{{id_artiste}}"><h2 class="nom">{{nom}} {{prenom}} {{nom_collectif}} </h2></a> 
        </header>
    </section>
 </template>

 <section class="contenu listeArtiste">
    <div class="titreListe">
            <h1>Artistes</h1>
            <h4>Les acteurs d'Art Public Montréal</h4>
    </div>
    <p class="textFiltrer">Rechercher :</p>
    <div class="contRecherche">
		<i class='fas fa-search'></i><input type="text" class="searchArtiste"/>
	</div>
    <input type="button" class ="btnRecherche" value ="chercher">
    <section class="oeuvres flex wrap parent">
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


			