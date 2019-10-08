<?php
/**
 * Class Vue
 * Modèle de classe Vue. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.1
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIMf
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
	   include "VueEntete.php";
		
	}

	/**
	 * Affiche entetes
	 * @access public
	 * @return void
	 */
	public function afficheEntete() {
		include "VueNavigation.php";		
	}


	/**
	 * Affiche le pied de page
	 * @access public
	 * @return void
	 */
	public function affichePied() {
		include "VuePied.php";
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
	 * Affiche la page à propos
	 * @access public
	 * @return void
	 */
	public function afficheApropos() {
        $this->afficheHead();
        $this->afficheEntete();
        include("VueApropos.php");
        $this->affichePied();
	}
	
	/**
	 * Affiche la liste des oeuvres
	 * @access public
	 * @return void
	 */
	public function afficheOeuvres($aData = Array(), $arrondissements, $materiaux) {
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
		$this->afficheHead();
		$this->afficheEntete();
		include("VueDetailOeuvre.html.php");
		$this->affichePied();
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
		$this->afficheHead();
		$this->afficheEntete();
        include("VueDetailArtiste.html.php");
		$this->affichePied();
	}

	public function afficherFormConnexion($msg, $action){
		$this->afficheHead();
		$this->afficheEntete();
		include("vues/formConnexion.php");
		$this->affichePied();

	}


	public function getFormAjoutOeuvre(){
		$this->afficheHead();
		$this->afficheEntete();
		include("formAjouterOeuvres.php");
		$this->affichePied();
	}

	public function getFormAjoutArtiste($msgErreur){
		$this->afficheHead();
		$this->afficheEntete();
		include("formAjouterArtistes.php");
		$this->affichePied();
	}

	public function getFormModifierOeuvre(){
		$this->afficheHead();
		$this->afficheEntete();
		include("formModifOeuvre.php");
		$this->affichePied();
	}

	public function getFormModifArtiste($aData, $msgErreur){
		$this->afficheHead();
		$this->afficheEntete();
		include("formModifArtiste.php");
		$this->affichePied();
	}

}
?>