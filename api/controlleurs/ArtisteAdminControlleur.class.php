<?php
/**
 * Class ArtisteAdminControlleur
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

class ArtisteAdminControlleur extends Controlleur 
{
	/** 	GET : 
	* 		oeuvre 			- Liste des oeuvres
	* 		oeuvre/sup/id 	- supprime une oeuvre
	*		oeuvre/mod/id 	- formullaire de modification une oeuvre
	* 		oeuvre/ajouter 	- formullaire d'ajout d'une oeuvre
	*		@param requete	- Recois un verbes et autre parametres qui sont utiliser pour la redirection
	*/

	public function getAction(Requete $requete)
	{
		$res = array();
		$msgErreur="";
		if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "sup"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$aData[] = $requete->url_elements[1];
				$string = $this->ArrayToString($aData);
				$this->supArtiste($string);
				header("Location:/art-pub-mtl/api/artisteAdmin");
			}
			else{
				echo "vous devez être connecté en tant qu'admin pour pouvoir supprimer";
			}	
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "mod"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$aData = $this->getArtiste((int)$requete->url_elements[1]);
				$this->getFormModif($aData, $msgErreur="");
			}
			else{
				echo "vous devez être connecté en tant qu'admin pour pouvoir modifier";
			}	
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$this->getFormAjout($msgErreur);				
			}
			else{
				echo "vous devez être connecté en tant qu'admin pour pouvoir ajouter";
			}
		}
        else 	
        {
			$filtre= "";
			$limit = 500;
			$res = $this->getListeArtiste($filtre, $limit);
			$oVue = new AdminVue;
			$oVue->afficheArtistes($res, $msgErreur = "");
			
		}
	}
		/**
		 * POST : 
		 * oeuvre/mod/insert 		modifie une oeuvre
		 * oeuvre/ajouter/insert 	ajoute une oeuvre
		 * @param requete	- Recois un verbes et autre parametres qui sont utiliser pour la redirection
		 */

	public function postAction(Requete $requete){
		if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($requete->url_elements[1]) && $requete->url_elements[1] == "insert"){
				$aData = Array();
				foreach($_POST as $cle=>$value){
					$aData[$cle] = $value;
				}
				$this->AjouterData($aData);
				header("Location: /art-pub-mtl/api/artisteAdmin");
			}
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "mod"){
			if(isset($requete->url_elements[1]) && $requete->url_elements[1] == "insert"){
				$aData = Array();
				foreach($_POST as $cle=>$value){
					$aData[$cle] = $value;
				}
				$this->modifData($aData, $msgErreur);
				header("Location: /art-pub-mtl/api/artisteAdmin");
			}
		}
		/**
		 * Validation supprimer avec le Checkbox
		 * Recois en paramètre POST une liste d'id à supprimer
		 */
		else if (isset($_POST['suppArt'])) {
			$msgErreur ="";
			if (isset($_POST['checks']) && is_array($_POST['checks'])) {
				$selected = array();
				$num_checks = count($_POST['checks']);
				foreach ($_POST['checks'] as $key => $value) {
						$selected[] = $value;
				}
			}
			if (empty($selected)){
				$msgErreur = 'Aucune artiste sélectionné';
				$res = $this->getListeArtiste();
				$oVue = new AdminVue();
				$oVue->afficheArtistes($res, $msgErreur);
			}

			if($msgErreur == ""){
				$string = $this->ArrayToString($selected);
				$this->supArtiste($string);
				header("Location:/art-pub-mtl/api/artisteAdmin");
			}
		}
	}


	/**
	 * Liste de tous les artistes selons les filtres et la limites recus
	 * @param filtre - string qui seras ajouter à la suite de la requête SQL
	 * @param limit - nombre pour limiter le nombre d'élément requis au chargement de la page.
	 * Returns la liste des artistes filtré ou non
	 */
	protected function getListeArtiste($filtre= "", $limit = 20){
		$oArtiste = new Artiste();
		$aArtiste = $oArtiste->getListe($filtre, $limit);
		return $aArtiste;
	}

	/**
	 * Information d'un seul artiste
	 * @param id_artiste - id de l'artiste
	 * Returns les détails d'un artiste
	 */
	protected function getArtiste($id_artiste){
		$oArtiste= new Artiste();
		$aArtiste = $oArtiste->getArtiste($id_artiste);		
		return $aArtiste;
	}

	/**
	 * Retourne la vue pour afficher le formullaire d'ajout
	 */
	protected function getFormAjout(){
		$oVue = new AdminVue();
		$oVue->getFormAjoutArtiste();
	}

	/**
	 * Ajoute dans la base de données le nouvel artiste
	 * @param aData - tableau des données du nouvel artiste entrée
	 */
	protected function AjouterData($aData){
		$oArtiste = new Artiste();
		$oArtiste->AjouterArtiste($aData);
	}
	
	/**
	 * Retourne la vue pour afficher le formullaire de modification
	 * @param aData 	- un tableau des champs rentré dans le formullaire de modificaiton
	 * @param msgErreur	- message d'erreur si on envoie un tableau vide
	 */
	protected function getFormModif($aData, $msgErreur = ""){
		$oVue = new AdminVue();
		$oVue->getFormModifArtiste($aData, $msgErreur);
	}

	/**
	 * Insère les données modifié dans la base de données
	 * @param aData 	- un tableau des champs rentré dans le formullaire de modificaiton
	 */
	protected function modifData($aData){
		$oArtiste = new Artiste();
		$oArtiste->modifierArtiste($aData);
	}
	
	// Section Supprimer
	/**
	 * envoie les id au modèle artiste pour supprimer les artistes et leurs liens ArtisteOeuvre
	 * @param string est une chaine de caractères qui s'additionne a la requete sql pour sélectionner les bon
	 * éléments a supprimer
	 */
	protected function supArtiste($string){
		$oArtiste= new Artiste();
		$oArtisteOeuvre= new ArtisteOeuvre();
		$aArtiste = $oArtiste->deleteArtiste($string);
		$aArtisteOeuvre = $oArtisteOeuvre->supprimerArtisteOeuvre($string);
	}
	/**
	 * Convertis les id et les intègre dans une fin de requete sql 
 	 * @param aData - Tableau d'id 
 	 */
	protected function ArrayToString($aData){
			$premier = true;
			foreach($aData as $id){
				if($premier == true){
					$res= "WHERE id_artiste = ". $id;
				}
				else{
					$res .=" OR  id_artiste = ". $id;
				}
				$premier = false;
			}
			return $res;
	}
}
?>