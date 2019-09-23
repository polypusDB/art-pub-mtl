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
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "sup"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$res = $this->supOeuvre($requete->url_elements[1]);
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
				
			}
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "mod"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$this->getFormMod();
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
				
			}
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$this->getFormAjout();
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
				
			}
		}
        else 	// La liste des oeuvres est a affiché
        {
			$res = $this->getListeOeuvre();
			$oVue = new Vue();
			$oVue->afficheOeuvres($res);
		}		
	}
	
	
	
	
	
		
	protected function getOeuvre($id_oeuvre)
	{
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getOeuvre($id_oeuvre);
		
		return $aOeuvre;
	}
	
	protected function getListeOeuvre()
	{
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getListe();
		return $aOeuvre;
	}

	protected function supOeuvre($id_oeuvre){
		echo "allo";
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->deleteOeuvre($id_oeuvre);
		header("Location:/art-pub-mtl/api/oeuvre");
	}

	protected function getFormAjout(){
		$oVue = new Vue();
		$oVue->getFormAjoutOeuvre();
	}

	protected function getFormMod(){
		$oVue = new Vue();
		$oVue->getFormModifierOeuvre();
	}
	
	
	
}
?>