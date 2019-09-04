<?php
/**
 * Class Vue
 * Modèle de classe Vue. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.1
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */


class Vue {

/**
	 * Affiche le head html
	 * @access public
	 * @return void
	 */
	public function afficheHead() {
		?>
		<!DOCTYPE html>
		<html lang="fr">
		
		<head>
		    <title>L'art public à Montréal</title>
		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		    <meta name="description" content="">
		    <meta name="viewport" content="width=device-width">
		    
			<link rel="stylesheet" href="../css/var.css" type="text/css" media="screen">
			<link rel="stylesheet" href="../css/flex.css" type="text/css" media="screen">
		    <link rel="stylesheet" href="../css/main.css" type="text/css" media="screen">
		    <!--<script src="../../js/plugins.js"></script>-->
		    <script src="../js/main.js"></script>
		</head>
		<?php
		
	}

	/**
	 * Affiche entetes
	 * @access public
	 * @return void
	 */
	public function afficheEntete() {
		?>
	<body>
	    <main>
	        <header class="appbar">
	            <h1><a href="/art-pub-mtl/api/">L'art public à Montréal</a></h1> 
	        </header>
			
		<?php
		
	}


	/**
	 * Affiche les oeuvres
	 * @access public
	 * @return void
	 */
	public function affichePied() {
		?>
	
			<footer>
				Certains droits réservés @ Jonathan Martel (2019)<br>
				Sous licence Creative Commons (BY-NC 3.0)
			</footer>
		</main>
	</body>
</html>

		<?php
		
	}
	

	/**
	 * Affiche la page d'accueil
	 * @access public
	 * @return void
	 */
	public function afficheAccueil($aData = Array()) {
		
		?>
		<section class="contenu listeOeuvres">
			<h1>Bienvenue sur le site Art public Montréal</h1>
			<ul>
				<li><a href="/art-pub-mtl/api/oeuvre">Voir les oeuvres</a></li>
				<li><a href="/art-pub-mtl/api/artiste">Voir les artistes</a></li>
			</ul>
		</section>
			
		<?php
		
	}
	
	/**
	 * Affiche la liste des oeuvres
	 * @access public
	 * @return void
	 */
	public function afficheOeuvres($aData = Array()) {
		
		?>
		 <section class="contenu listeOeuvres">
         	<section class="recherche"></section>
            <section class="oeuvres flex wrap">
						<?php
						foreach ($aData as $cle => $oeuvre) {
							extract($oeuvre);
							?>
							<section class="oeuvre carte">
			                    <header class="image dummy">
			                        <h2 class="titre"><?php echo $Titre?></h2> 
			                    </header>
			                    <section class="texte">
			                        <p class="description">
			                            <?php echo $Description ?> 
									</p>
                                    <p>Par :</p>
									<?php 
									foreach($Artistes as $artiste){
										extract($artiste);
										?>
									<p class="auteur"><a href="artiste/<?php echo $id_artiste ?>"><?php if($Nom != '' || $Prenom != '') { echo $Nom .", ". $Prenom; } else { echo $NomCollectif; } ?></a></p>
									<?php
									}

									?>
			                        <p class="arrondissement"><?php echo $Arrondissement?></p>
			                    </section>
			                    <footer class="barre-action">
								<a class="ouvrir-oeuvre" href="oeuvre/<?php echo $id ?>" data-link="/artPublic/api/oeuvre/<?php echo $id_oeuvre ?>/" data-id="<?php echo $id_oeuvre ?>">En savoir plus...</a>	
								<!--<button class="ouvrir-oeuvre" data-link="/artPublic/api/oeuvre/<?php echo $id_oeuvre ?>/" data-id="<?php echo $id_oeuvre ?>">En savoir plus...</button>-->
			                    </footer>
			                </section>
							
							
							
							
							
							<?php
							/*
							 <section class="oeuvre">
								<h2 class="titre"><a href="/artPublic/api/oeuvre/<?php echo $oeuvre['id'] ?>"><?php echo $oeuvre['Titre']?></a></h2>	
							</section>
							 */
						}
						?>
					</section>
				
			</section>
			
		<?php
		
	}

	/**
	 * Affiche le détails d'une oeuvre
	 * @access public
	 * @return void
	 */
	public function afficheOeuvre($aData = Array()) {
		extract($aData);
		?>
		 <section class="contenu uneOeuvre flex flex-col">
		 	<section class="retour"><a href="/art-pub-mtl/api/oeuvre"> Retour à la liste  </a></section>
            <section class="oeuvre flex wrap">
                <header class="image dummy">
                	<img src="/art-pub-mtl/img/placeholder_640_480.jpg" />
                    <h2 class="titre"><?php echo $Titre?></h2>
                </header>
                    
                        
                <section class="texte">
					<p class="description"><?php echo $Description ?></p>
						<?php
						foreach($Artistes as $artiste){
							extract($artiste);
							?>
							<p class="auteur">Par : <a href="artiste/<?php echo $id_artiste ?>"><?php if($Nom != '' || $Prenom != '') { echo $Nom .", ". $Prenom; } else { echo $NomCollectif; } ?></a></p>

						<?php
						}

						?>
                   
			    	<p class="arrondissement"><?php echo $Arrondissement?></p>
                </section>
                
            </section>

        </section>
        
							
			
		<?php
		
	}


	/**
	 * Affiche la liste des artistes
	 * @access public
	 * @return void
	 */
	public function afficheArtistes($aData = Array()) {
		
		?>
		 <section class="contenu listeArtiste">
            <section class="oeuvres-flex-wrap">
						<?php
						foreach ($aData as $cle => $artiste) {
							extract($artiste);
							?>
							<section class="artiste-carte">
			                    <header class="">
			                        <a href="artiste/<?php echo $id_artiste ?>"><h2 class="nom"><?php if($Nom != '' || $Prenom != '') { echo $Nom .", ". $Prenom; } else { echo $NomCollectif; } ?></h2></a> 
			                    </header>
			                </section>
							<?php
						}
						?>
					</section>
				
			</section>
			
		<?php
						
	}


/**
	 * Affiche le détails d'un artiste
	 * @access public
	 * @return void
	 */
	public function afficheArtiste($aData = Array()) {
		extract($aData);
		?>
		 <section class="contenu uneOeuvre flex flex-col">
		 	
            <section class="artiste flex wrap">
                <header class="">
                    <h2 class="nom"><?php if($Nom != '' || $Prenom != '') { echo $Nom .", ". $Prenom; } else { echo $NomCollectif; }?></h2>
                </header>
            </section>

        </section>
			
		<?php
		
	}


}
?>