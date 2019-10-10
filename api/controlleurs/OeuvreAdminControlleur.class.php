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
 

class OeuvreAdminControlleur extends OeuvreControlleur 
{

	public function getAction(Requete $requete)
	{
		$res = array();
        $oArtiste = new Artiste();
        $oCategorie = new Categorie();
        $oTypeSupport = new TypeSupport();
        $oArrondissement = new Arrondissement();
        $liste_artiste = $oArtiste->getListe();
        $liste_categorie = $oCategorie->getListe();
        $liste_support = $oTypeSupport->getListe();
        $liste_arrondissement = $oArrondissement->getListe();
        $msgErreur ="";
		
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// l'id de l'oeuvre 
		{
			$id_oeuvre = (int)$requete->url_elements[0];            
			$res = $this->getOeuvre($id_oeuvre);
			$oVue = new AdminVue();
			$oVue->afficheOeuvre($res);
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "sup"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$res = $this->supOeuvre($requete->url_elements[1]);
				header("Location:/art-pub-mtl/api/OeuvreAdmin");
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
				$this->getFormAjout($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
			}
		}
		//La liste des oeuvres est a affiché
        else 
        {
			$res = $this->getListeOeuvre();
			$oVue = new AdminVue();
			$oVue->afficheOeuvres($res);
		}		
		
		
	}

	public function postAction(Requete $requete){
        $oCategorie = new Categorie();
        $oTypeSupport = new TypeSupport();
        $oArrondissement = new Arrondissement();
        $oArtiste = new Artiste();
        $liste_categorie = $oCategorie->getListe();
        $liste_support = $oTypeSupport->getListe();
        $liste_arrondissement = $oArrondissement->getListe();
        $liste_artiste = $oArtiste->getListe();
        $msgErreur ="";
		if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($requete->url_elements[1]) && $requete->url_elements[1] == "insert"){
				if(empty(trim($_POST["titre"]))) {
                    $msgErreur.= "Vous devez saisir un titre. <br>";
                }
                
                if(empty(trim($_POST["dimension"]))) {
                    $msgErreur.= "Vous devez saisir une dimension. <br>";
                }
                
                if($_POST["id_support"] == "choix")
                {
                    if(empty(trim($_POST["support_nom_francais"])) && empty(trim($_POST["support_nom_anglais"]))) {
                             $msgErreur.= "Vous devez saisir un type de support ou le choisir dans la liste déroulante.<br>";
                    }                     
                }
                
                if(empty(trim($_POST["description"]))) {
                    $msgErreur.= "Vous devez saisir une description en français. <br>";
                }

                if(empty(trim($_POST["description_anglais"]))) {
                    $msgErreur.= "Vous devez saisir une description en anglais. <br>";
                }
                              
                if($_POST["id_categorie"] == "choix") {
                     $msgErreur.= "Vous devez choisir une catégorie dans la liste. <br>";
                }
                
                if($_POST["id_artiste"] == "choix") {
                     $msgErreur.= "Vous devez choisir un artiste dans la liste. <br>";
                }
                
                if(empty(trim($_POST["parc"])) && empty(trim($_POST["batiment"])) && empty(trim($_POST["adresse"]))) {
					$msgErreur.= "Vous devez saisir un parc, un bâtiment ou une adresse civique<br>";
                }
                
                if(empty(trim($_POST["coordonnee_latitude"]))) {
                    $msgErreur.= "Vous devez saisir une coordonnée pour la latitude.<br>";                               
                }
                
                if(empty(trim($_POST["coordonnee_longitude"]))) {
                    $msgErreur.= "Vous devez saisir une coordonnée pour la longitude.<br>";
                }

				// Si le message d'erreur est vide on lance l'ajout, sinon on affiche le message
				if($msgErreur == ""){
					$aData = Array();
					foreach($_POST as $cle=>$value){
						$aData[$cle] = $value;
					}

					$this->AjouterData($aData);
					header("Location: /art-pub-mtl/api/admin");
				}
				else{
					$this->getFormAjout($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
				}

			}

		}
	}
/* 		else if (isset($requete->url_elements[0]) && $requete->url_elements[0] == "mod"){
			// modification de l'oeuvre ici!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
	
	// Section Oeuvres
	protected function getOeuvre($id_oeuvre){
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getOeuvre($id_oeuvre);
		return $aOeuvre;
	}
	
	protected function getListeOeuvre(){
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getListe();
		return $aOeuvre;
	}

	protected function supOeuvre($id_oeuvre){
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->deleteOeuvre($id_oeuvre);
	}

	protected function getFormAjout($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur){
		$oVue = new AdminVue();
		$oVue->getFormAjoutOeuvre($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
	}

	protected function getFormMod(){
		$oVue = new AdminVue();
		$oVue->getFormModifierOeuvre();
	}
	
	protected function AjouterData($aData){
        $oTraitementDonnees = new TraitementDonnees();
        $oArtisteOeuvre = new ArtisteOeuvre();
        $tabTypeSupport = Array();
        
        $aData['id_arrondissement'] = intval($aData['arrondissement']);
        $aData['id_endroit'] = $oTraitementDonnees->traiterEndroit($aData);

        if($aData['id_support'] == "choix")
        {
            $aData['id_support'] = $oTraitementDonnees->traiterTypeSupport(trim(mb_strtolower($aData['support_nom_francais']), 'UTF-8'),trim(mb_strtolower($aData['support_nom_anglais']), 'UTF-8'));
        }
        
        if(($aData['id_categorie'] != 0) && ($aData['id_support'] != 0) && ($aData['id_endroit'] != 0))
        {
            $aData['id_oeuvre'] = $oTraitementDonnees->traiterOeuvre($aData);
        }
        
        if($aData['id_oeuvre'] > 0)
        {
            $oArtisteOeuvre->ajouterArtisteOeuvre($aData['id_artiste'],$aData['id_oeuvre']);
        }
	}	
}
?>