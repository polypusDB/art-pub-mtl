<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2016-03-03
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 /*
 * TODO : Commenter selon les standards du département.
 *
 */

 
 
class OeuvreControlleur extends Controlleur 
{
	
	// GET : 
	// 		/oeuvre/ - Liste des oeuvres
	// 		/oeuvre/{id}/ - Une oeuvre
	// 		/oeuvre/sup/{id}/ - supprime une oeuvre
	// 		/oeuvre/ajouter - ajoute une oeuvre
	// 		/oeuvre/?q=nom,arrond,etc&valeur=chaineDeRecherche
	
	public function getAction(Requete $requete)
	{
		$res = array();
		// var_dump($requete->url_elements);
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// Normalement l'id de l'oeuvre 
		{
			$id_oeuvre = (int)$requete->url_elements[0];            
			$res = $this->getOeuvre($id_oeuvre);
			
			$oVue = new Vue();
			$oVue->afficheOeuvre($res);
			
            
		}
        else 	// La liste des oeuvres est a affiché
        {
			$res = $this->getListeOeuvre();
			$arrondissements = $this->getArrondissement();
			$oVue = new Vue();
			$oVue->afficheOeuvres($res, $arrondissements);
		}		
	}

	public function postAction(){
		// var_dump($_POST);
		var_dump(json_decode($_POST));
	}
	
		
	protected function getOeuvre($id_oeuvre)
	{
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getOeuvre($id_oeuvre);

		$oCommentaire = new Commentaire();
		$aOeuvre["commentaires"] = $oCommentaire->ListeCommentairesParOeuvreID($id_oeuvre);
		return $aOeuvre;
	}
	
	protected function getListeOeuvre()
	{
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getListe();
		return $aOeuvre;
	}


	protected function getArrondissement()
	{
		$oArrondissement = new Arrondissement();
		$aArrondissement = $oArrondissement->getListe();
		return $aArrondissement;
	}

	
}
?>