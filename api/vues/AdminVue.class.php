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
	 */
	public function afficheHead() {
		include "admin/VueEnteteAdmin.php";
	}

	/**
	 * Affiche navigation
	 */
	public function afficheEntete() {
		include "admin/VueNavigationAdmin.php";	
	}

	/**
	 * Affiche le pied de page
	 */
	public function affichePied() {
		include "admin/VuePiedAdmin.php";
	}
	
	/**
	 * Affiche la page d'accueil
	 */
	public function afficheAccueilAdmin($aDataArt, $aDataOeu) {
        $this->afficheHead();
        $this->afficheEntete();
        include "admin/VueAccueil.php";
	}

	/**
	 * ARTISTES
	 * Affiche la liste des artistes
	 */
	public function afficheArtistes($aData = Array()) {
		$this->afficheHead();
		$this->afficheEntete();
		include("admin/VueListeArtisteAdmin.php");
	}

	/**
	 * Affiche le détails d'un artiste
	 */
	public function afficheArtiste($aData = Array()) {
		$this->afficheHead();
		$this->afficheEntete();
        include("admin/VueDetailArtisteAdmin.php");
	}

	/**
	 * Affiche le Formulaire pour ajouter un artiste
	 */
	public function getFormAjoutArtiste(){
		$this->afficheHead();
		$this->afficheEntete();
		include("admin/formAjouterArtistes.php");
	}

	/**
	 * Affiche le Formulaire pour modifier un artiste
	 */
	public function getFormModifArtiste($aData, $msgErreur){
		$this->afficheHead();
		$this->afficheEntete();
		include("admin/formModifArtiste.php");
	}

	/**
	 * OEUVRES
	 * Affiche la liste des oeuvres
	 */
	public function afficheOeuvres($aData = Array()) {
		$this->afficheHead();
		$this->afficheEntete();
		include("admin/VueListeOeuvreAdmin.php");
	}

	/**
	 * Affiche le Formulaire pour ajouter un oeuvre
	 */
	public function getFormAjoutOeuvre($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur){
		$this->afficheHead();
		$this->afficheEntete();
		include("admin/formAjouterOeuvres.php");
	}

	/**
	 * Affiche le Formulaire pour modifier un oeuvre
	 */
	public function getFormModifierOeuvre(){
		$this->afficheHead();
		$this->afficheEntete();
		include("admin/formModifOeuvre.php");
	}

	
}
?>