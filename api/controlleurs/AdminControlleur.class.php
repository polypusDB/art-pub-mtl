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
 
 /*
 * TODO : Commenter selon les standards du département.
 *
 */

 
 
class AdminControlleur extends Controlleur 
{
	
	// GET : 
	
	public function getAction(Requete $requete)
	{
		if($_SESSION["utilisateur"]["type_acces"] == "admin"){
			if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "artistes"){
				if(isset($requete->url_elements[1]) && $requete->url_elements[1] == "ajouter"){
					$this->getFormAjout();
				}
				else{
					$aData = $this->getListeArtiste();
					$oVue = new AdminVue();
					$oVue->afficheArtistes($aData);
				}
			}
			else{
				$oVue = new AdminVue();
				$oVue->afficheAccueilAdmin();
			}
		}
		else{
			echo "tu n'est pas un admin";
		}
		//var_dump($requete->url_elements[1]);


	}
	protected function getListeArtiste(){
		$oArtiste = new Artiste();

		$aArtiste = $oArtiste->getListe();
		return $aArtiste;
	}

	protected function getFormAjout(){
		$oVue = new AdminVue();
		$oVue->getFormAjoutArtiste();
	}
	
}
?>