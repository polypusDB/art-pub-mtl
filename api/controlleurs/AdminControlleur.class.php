<?php
/**
 * Class AdminControlleur
 * Gère la page d'accueil
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 

class AdminControlleur extends Controlleur 
{
	
	public function getAction(Requete $requete){
		$res = array();
		if($_SESSION["utilisateur"]["type_acces"] == "admin"){
			$resArt = $this->getListeArtiste();
			$resOeu = $this->getListeOeuvre();
			$oVue = new AdminVue();
			$oVue->afficheAccueilAdmin($resArt, $resOeu);
		}
		else{
			echo "tu n'est pas un admin";
		}
		
	}

	protected function getListeArtiste(){
		$oArtiste = new Artiste();
		$aArtiste = $oArtiste->getListe();
		return $aArtiste;
	}

	protected function getListeOeuvre(){
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getListe();
		return $aOeuvre;
	}


}
?>