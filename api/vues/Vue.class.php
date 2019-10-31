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

    /* Affiche le head html ---------------- */
	public function afficheHead() {
	   include "VueEntete.php";
		
	}

	/* Affiche entetes ---------------- */
	public function afficheEntete() {
		include "VueNavigation.php";		
	}


	/* Affiche le pied de page ---------------- */
	public function affichePied() {
		include "VuePied.php";
	}
	

	
	public function afficheAccueil() {
        $this->afficheHead();
        $this->afficheEntete();
        include("VueHome.php");
        $this->affichePied();
	}

	/* Affiche la page à propos ---------------- */
	public function afficheApropos() {
        $this->afficheHead();
        $this->afficheEntete();
        include("VueApropos.php");
        $this->affichePied();
	}
	
	/* Affiche la liste des oeuvres ---------------- */
	public function afficheOeuvres($aData = Array(), $arrondissements, $materiaux, $categories) {
		$this->afficheHead();
		$this->afficheEntete();
		include("VueListeOeuvre.html.php");
		$this->affichePied();
		
	}

    /* Affiche le détails d'une oeuvre ---------------- */
	public function afficheOeuvre($aData = Array()) {
		$this->afficheHead();
		$this->afficheEntete();
		include("VueDetailOeuvre.html.php");
		$this->affichePied();
	}


	/* Affiche la liste des artistes ---------------- */
	public function afficheArtistes($aData = Array()) {
		$this->afficheHead();
		$this->afficheEntete();
		include("VueListeArtiste.html.php");
		$this->affichePied();
	}

    /*Affiche le détails d'un artiste ---------------- */
	public function afficheArtiste($aData = Array()) {
		$this->afficheHead();
		$this->afficheEntete();
        include("VueDetailArtiste.html.php");
		$this->affichePied();
	}
    
    
    /*Affiche la liste des parcours ---------------- */ 
    public function afficheParcours() {
		$this->afficheHead();
		$this->afficheEntete();
        include("VueParcours.html.php");
		$this->affichePied();
	}
    
    /*Affiche les détails des parcours ---------------- */
    /* Parcours numéro 1 */
    public function afficheDetailParcours1() {
		$this->afficheHead();
		$this->afficheEntete();
        include("VueDetailParcours1.html.php");
		$this->affichePied();
	}
    
    /* Parcours numéro 2 */
    public function afficheDetailParcours2() {
		$this->afficheHead();
		$this->afficheEntete();
        include("VueDetailParcours2.html.php");
		$this->affichePied();
	}
    
    /* Parcours numéro 3 */
    public function afficheDetailParcours3() {
		$this->afficheHead();
		$this->afficheEntete();
        include("VueDetailParcours3.html.php");
		$this->affichePied();
	}

    /* Affiche le formulaire de connexion ---------------- */
	public function afficherFormConnexion($msg, $action){
		$this->afficheHead();
		$this->afficheEntete();
		include("vues/formConnexion.php");
		$this->affichePied();

	}

    /* Affiche le formulaire d'ajout d'une oeuvre ---------------- */
	public function getFormAjoutOeuvre($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur){
		$this->afficheHead();
		$this->afficheEntete();
		include("formAjouterOeuvres.php");
		$this->affichePied();
	}

    /* Affiche le formulaire d'ajout d'un artiste ---------------- */
	public function getFormAjoutArtiste($msgErreur){
		$this->afficheHead();
		$this->afficheEntete();
		include("formAjouterArtistes.php");
		$this->affichePied();
	}

	public function getFormModifierOeuvre($aData, $liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur){
		$this->afficheHead();
		$this->afficheEntete();
		include("formModifOeuvre.php");
		$this->affichePied();
	}

    /* Affiche le formulaire de modification d'un artiste ---------------- */
	public function getFormModifArtiste($aData, $msgErreur){
		$this->afficheHead();
		$this->afficheEntete();
		include("formModifArtiste.php");
		$this->affichePied();
	}

	public function AfficherUsager($aData){
		$this->afficheHead();
		$this->afficheEntete();
		include("VueUsager.php");
		$this->affichePied();
	}

}
?>