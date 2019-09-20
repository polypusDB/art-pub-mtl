<?php
/**
 * Controlleur de la ressource Artiste
 * 
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2016-11-16
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 /*
 * 
 *
 */

 
 
class ArtisteControlleur extends Controlleur 
{
	// GET : 
	// 		/artiste/ - Liste des oeuvres
	// 		/artiste/{id}/ - Une oeuvre
	// 		/artiste/?q=nom,prenom,etc&valeur=chaineDeRecherche
	
	public function getAction(Requete $requete)
	{
		$res = array();
		$msgErreur="";
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// Normalement l'id de l'artiste 
		{
            $id_artiste = (int)$requete->url_elements[0];
			$res = $this->getArtiste($id_artiste);
			$oVue = new Vue;
			$oVue->afficheArtiste($res);
            
		} // si sup on regarde l'id et on supprime
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "sup"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				
				$this->supArtiste((int)$requete->url_elements[1]);
				header("location: /art-pub-mtl/api/artiste");
			}
			else{
				echo "vous devez être connecté en tant qu'admin pour pouvoir supprimer";
			}	
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$this->getFormAjout($msgErreur);				
			}
			else{
				echo "vous devez être connecté en tant qu'admin pour pouvoir supprimer";
			}
		}
        else 	// Liste des oeuvres
        {
			$res = $this->getListeArtiste();
			$oVue = new Vue;
			$oVue->afficheArtistes($res);
			
		}
		
		


		
		// if(isset($_GET['json']))
		// {
		// 	echo json_encode($res);	
		// }

			
		
		
	}

	public function postAction(Requete $requete){
		if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($requete->url_elements[1]) && $requete->url_elements[1] == "insert"){
				$msgErreur ="";

				if(empty(trim($_POST["nom_collectif"]))){
					if(empty(trim($_POST["nom"])) && empty(trim($_POST["prenom"]))){
						$msgErreur.= "Vous devez remplir le champ nom collectif ou nom et prenom. <br>";
					}
					else if(empty(trim($_POST["nom"])) || empty(trim($_POST["prenom"]))){
						$msgErreur.= "Vous devez remplir le champ prenom et prénom ou un nom collectif. <br>";
					}
				}
				if(empty($_POST["biographie"])){
					$msgErreur .= "Vous devez remplir le champ biographie. <br>";
				}

				// Si le message d'erreur est vide on lance l'ajout, sinon on affiche le message
				if($msgErreur == ""){
					$aData = Array();
					foreach($_POST as $cle=>$value){
						$aData[$cle] = $value;
					}
						$this->AjouterData($aData);
						header("Location: /art-pub-mtl/api/artiste");
				}
				else{
					
					$this->getFormAjout($msgErreur);
				}

			}

		}
	}

	protected function getArtiste($id_artiste)
	{
		$oArtiste= new Artiste();
		$aArtiste = $oArtiste->getArtiste($id_artiste);
		$oOeuvre = new Oeuvre();
		$aArtiste['oeuvres'] = $oOeuvre->getOeuvresParArtiste($id_artiste);
		
		return $aArtiste;
	}
	
	protected function getListeArtiste()
	{
		
		$oArtiste= new Artiste();
		$aArtiste = $oArtiste->getListe();
		
		return $aArtiste;
	}

	protected function supArtiste($id_artiste){

		$oArtiste= new Artiste();
		$aArtiste = $oArtiste->deleteArtiste($id_artiste);
	}

	
	protected function getFormAjout($msgErreur){
		$oVue = new Vue;
		$oVue->getFormAjoutArtiste($msgErreur);
	}

	protected function AjouterData($aData){
		$oArtiste = new Artiste;
		$oArtiste->AjouterArtiste($aData);


	}
	
	
}
?>