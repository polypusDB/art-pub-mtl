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
 
 
class OeuvreControlleur extends Controlleur 
{
	public function getAction(Requete $requete)
	{
		$res = array();
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// l'id de l'oeuvre 
		{
			$id_oeuvre = (int)$requete->url_elements[0];            
			$res = $this->getOeuvre($id_oeuvre);
			
			$oVue = new Vue();
			$oVue->afficheOeuvre($res);
			
            
		}
		// La liste des oeuvres est a affiché
        else 
        {
			$res = $this->getListeOeuvre();
			$arrondissements = $this->getArrondissement();
			$oVue = new Vue();
			$oVue->afficheOeuvres($res, $arrondissements);
		}		
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