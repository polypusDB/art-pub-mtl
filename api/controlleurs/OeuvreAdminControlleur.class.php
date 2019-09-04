<?php
/**
 * Class OeuvreAdminControlleur
 * Gère les requêtes HTTP de l'admin
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-08-12
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 /*
 * TODO : Commenter selon les standards du département.
 *
 */

 
 
class OeuvreAdminControlleur extends OeuvreControlleur 
{
	
	// GET : 
	// 		/oeuvre/ - Liste des oeuvres
	// 		/oeuvre/{id}/ - Une oeuvre
	// 		/oeuvre/?q=nom,arrond,etc&valeur=chaineDeRecherche
	
	public function getAction(Requete $requete)
	{
		$res = array();
		//var_dump($requete->url_elements);
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// Normalement l'id de l'oeuvre 
		{
            $id_oeuvre = (int)$requete->url_elements[0];
            
            $res = $this->getOeuvre($id_oeuvre);
            
        } 
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "miseajour")
		{
			$res = $this->mettreAJour();
		}
        else 	// Liste des oeuvres
        {
        	$res = $this->getListeOeuvre();
			
        }
		
		if(isset($_GET['json']))
		{
			echo json_encode($res);	
		}
		else
		{
				
			
			$oVue = new AdminVue();
			$oVue->afficheHead();
			$oVue->afficheEntete();
			if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))
			{
				//var_dump($res);
				$oVue->afficheOeuvre($res);	
			}
			else
			{
				$oVue->afficheOeuvres($res);
			}	
			
			$oVue->affichePied();
			
		}
			
		
		
	}
	
	
	public function postAction(Requete $requete)
	{
		$res = array();
		//var_dump($requete->url_elements);
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// Normalement l'id de l'oeuvre 
		{
            $id_oeuvre = (int)$requete->url_elements[0];
            //var_dump($requete->parametres);
            $res = $this->modifOeuvre($id_oeuvre, $requete->parametres);
            
        } 
		
		if(isset($_GET['json']))
		{
			echo json_encode($res);	
		}
		
	}
	
	protected function modifOeuvre($id_oeuvre, $param)
	{
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->modifOeuvre($id_oeuvre, $param);
		
		return $aOeuvre;
	}
	
	/**
	 * Fait l'importation et la mise à jour des oeuvres et des artistes 
	 * @access private
	 * @TODO Ajouter la mise à jour des artistes
	 */
	private function mettreAJour()
	{
		$oImportation = new Importation();
		$oImportation->importerOeuvre();
		$oImportation->mettreAJour();
		
	}
	
	private function getImages($id_oeuvre)
	{
		$oImportation = new Importation();
		$aImage = $oImportation->telechargementImages($id_oeuvre);
		
	}
	
}
?>