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


class AdminVue {

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
		    <title>L'art public à Montréal - admin</title>
		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		    <meta name="description" content="">
		    <meta name="viewport" content="width=device-width">
		    
		    <link rel="stylesheet" href="<?php echo BASE_URL."css/flex.css"?>" type="text/css" media="screen">
		    <link rel="stylesheet" href="<?php echo BASE_URL."css/adminmain.css"?>" type="text/css" media="screen">
		    
		    <script src="<?php echo BASE_URL."js/define.js"?>"></script>
		    <script src="<?php echo BASE_URL."js/admin.js"?>"></script>
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
	            <h1><a href="/art-pub-mtl/api/admin">L'art public à Montréal (Admin)</a></h1> 
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
	 * Affiche la liste des oeuvres
	 * @access public
	 * @return void
	 */
	public function afficheOeuvres($aData = Array()) {
		
		?>
		 <section class="contenu listeOeuvres">
         	<section class="recherche"></section>
            <section class="oeuvres flex flex-col">
						<?php
						foreach ($aData as $cle => $oeuvre) {
							extract($oeuvre);
							?>
							<section class="oeuvre flex flex-row">
			                    <span class="titre"><?php echo $Titre?></span>
			                    <span class ="description"> <?php echo $Description ?> </span>
			                    <span class="arrondissement"><?php echo $Arrondissement?></span>
			                    <!-- <span class="action flex-droite">[x] <a href="/artPublic/api/admin/oeuvre/<?php echo $id ?>">[modif]</a></span> -->
			                    
			                </section>

							<?php
						}
						?>
					</section>
				
			</section>
			
		<?php
		
	}

}
?>