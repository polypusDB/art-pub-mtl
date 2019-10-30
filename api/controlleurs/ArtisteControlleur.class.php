<?php
/**
 * Class ArtisteControlleur
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

class ArtisteControlleur extends Controlleur 
{
	/**
	 * GET : 
	 * 		/artiste/ - Liste des oeuvres
	 * 		/artiste/{id}/ - Une oeuvre
	 * 		@param requete	- Recois un verbes et autre parametres qui sont utiliser pour la redirection
	 */
	public function getAction(Requete $requete)
	{
		$res = array();
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))
		{
            $id_artiste = (int)$requete->url_elements[0];
			$res = $this->getArtiste($id_artiste);
			$oVue = new Vue;
			$oVue->afficheArtiste($res);
            
		}
        else /** Listes des Artistes */
        {
			$res = $this->getListeArtiste();
			$oVue = new Vue;
			$oVue->afficheArtistes($res);
			
		}
	}

	/**
	 * Va chercher les détails d'un artiste et les oeuvres produites par celui-ci.
	 * @param id_artiste - id de l'artiste recherch.
	 * Retourne un tableau des détails de l'artistes ainsi que les oeuvres qu'il a prosuite.
	 */
	protected function getArtiste($id_artiste)
	{
		$oArtiste= new Artiste();
		$aArtiste = $oArtiste->getArtiste($id_artiste);
		$oOeuvre = new Oeuvre();
		$aArtiste['oeuvres'] = $oOeuvre->getOeuvresParArtiste($id_artiste);
		
		return $aArtiste;
	}
	
	/**
	 * Va chercher un tableau des artistes
	 * Retourne le tableau de la liste des artistes
	 */
	protected function getListeArtiste()
	{
		$oArtiste= new Artiste();
		$aArtiste = $oArtiste->getListe();
		
		return $aArtiste;
	}
	


	
	
}
?>