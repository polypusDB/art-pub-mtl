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
	   include("VueEntete.php");
		
	}

	/**
	 * Affiche entetes
	 * @access public
	 * @return void
	 */
	public function afficheEntete() {
		include("VueNavigation.php");		
	}


	/**
	 * Affiche le pied de page
	 * @access public
	 * @return void
	 */
	public function affichePied() {
		include("VuePied.php");
	}
	

	/**
	 * Affiche la page d'accueil
	 * @access public
	 * @return void
	 */
	public function afficheAccueil() {
        $this->afficheHead();
        $this->afficheEntete();
        include("VueHome.php");
        $this->affichePied();
        
		
	}
	
	/**
	 * Affiche la liste des oeuvres
	 * @access public
	 * @return void
	 */
	public function afficheOeuvres($aData = Array()) {
		$this->afficheHead();
		$this->afficheEntete();
		include("VueListeOeuvre.html.php");
		$this->affichePied();
		
	}

	/**
	 * Affiche le détails d'une oeuvre
	 * @access public
	 * @return void
	 */
	public function afficheOeuvre($aData = Array()) {
		extract($aData);
		var_dump($aData);
		?>
		 <section class="contenu uneOeuvre flex flex-col">
		 	<section class="retour"><a href="/art-pub-mtl/api/oeuvre/"> Retour à la liste  </a></section>
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
		$this->afficheHead();
		$this->afficheEntete();
		include("VueListeArtiste.html.php");
		$this->affichePied();
	}


/**
	 * Affiche le détails d'un artiste
	 * @access public
	 * @return void
	 */
	public function afficheArtiste($aData = Array()) {
		// $this->afficheHead();
		// $this->afficheEntete();
		extract($aData);

		var_dump($oeuvres[1]);
		
		?>
		 <section class="contenu uneOeuvre flex flex-col">
		 	
            <section class="artiste flex wrap">
                <header class="">
                    <h2 class="nom"><?php if($nom != '' || $prenom != '') { echo $nom .", ". $prenom; } else { echo $NomCollectif; }?></h2>
                </header>
				<h2>Oeuvres produites par cet artiste</h2>
				<?php
					foreach($oeuvres as $oeuvre){
						extract($oeuvre)
						?>
						<a href = "/art-pub-mtl/api/oeuvre/<?= $id_oeuvre?>"><?=$titre ?></a><br>
					<?php
					}
				?>
            </section>

        </section>
			
		<?php
		// $this->affichePied();
	}

	public function afficherFormConnexion(){
		$this->afficheHead();
		$this->afficheEntete();
		include("vues/formConnexion.php");
		$this->affichePied();

	}


}
?>