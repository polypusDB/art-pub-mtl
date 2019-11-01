<?php
/**
 * Class OeuvreAdminControlleur
 * Gère les requêtes HTTP de l'admin
 * 
 * @author Jonathan Martel modifié par Michel Plamondon et Saul Turbide
 * @version 1.0
 * @update 2019-08-12
 * @update 2019-10-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 * Cette classe à gérer l'ajout, la modification et la suppression d'une oeuvre selon les données saisies par l'usager.
 *
 */
 

class OeuvreAdminControlleur extends OeuvreControlleur 
{
	/**
	 * Effectue la répartition de la requête demandée par l'usager.
	 * @access public
	 * @param Requete $requete Le paramètre reçu est un objet Requete.
	 */    
	public function getAction(Requete $requete)
	{
		$res = array(); // Conserve le résultat d'une liste d'informations provenant de la base de données.
        // Instanciation des classes pour effectuer la gestion des oeuvres.
        $oArtiste = new Artiste();
        $oCategorie = new Categorie();
        $oTypeSupport = new TypeSupport();
        $oArrondissement = new Arrondissement();
        
        // Obtenir des listes d'informations pour faciliter l'ajout ou la modification d'une oeuvre.
        $liste_artiste = $oArtiste->getListe("",500);
        $liste_categorie = $oCategorie->getListe();
        $liste_support = $oTypeSupport->getListe();
        $liste_arrondissement = $oArrondissement->getListe();
        $msgErreur ="";
        $listeMsgErreur = array();
        $listeMsgErreur["titre"] = "";
        $listeMsgErreur["support"] = "";
        $listeMsgErreur["description"] = "";
        $listeMsgErreur["categorie"] = "";
        $listeMsgErreur["artiste"] = "";
        $listeMsgErreur["parc"] = "";
        $listeMsgErreur["coordonnee_latitude"] = "";
        $listeMsgErreur["coordonnee_longitude"] = "";
        $listeMsgErreur["arrondissement"] = "";
		
        // Répartition des actions selon la requête demandée par l'usager.
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// l'id de l'oeuvre 
		{
			$id_oeuvre = (int)$requete->url_elements[0];            
			$res = $this->getOeuvre($id_oeuvre);
			$oVue = new AdminVue();
			$oVue->afficheOeuvre($res);
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "sup"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$aData[] = $requete->url_elements[1];
                $string = $this->ArrayToString($aData);
                echo "fuck";
				$this->supOeuvre($string);
				header("Location:/art-pub-mtl/api/OeuvreAdmin");
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
			}
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "mod"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
         		$aData = $this->getOeuvre((int)$requete->url_elements[1]);
                $oOeuvreMateriaux = new OeuvreMateriaux();
                $oOeuvreTechnique = new OeuvreTechnique();
                $oArtisteOeuvre = new ArtisteOeuvre();
                // Fonction temporaire pour aller chercher le dernier artiste. Cette partie de code sera modifiée dans le prochain sprint pour tenir compte de plusieurs artistes.
                $donnees = $oArtisteOeuvre->getDernierEnregistrement($aData['id_oeuvre']);
                $aData['id_artiste'] = $donnees['dernier'];
                    
                $liste_materiaux = $oOeuvreMateriaux->getOeuvreMateriauxByIdOeuvre($aData['id_oeuvre']);
                $materiaux_francais = "";
                $materiaux_anglais = "";
                if($liste_materiaux != 0)
                {
                    foreach($liste_materiaux as $element)
                    {
                        $materiaux_francais.= $element['nom_francais'].";";
                        $materiaux_anglais.= $element['nom_anglais'].";";
                    }
                    $materiaux_francais = substr_replace($materiaux_francais ,"", -1);
                    $materiaux_anglais = substr_replace($materiaux_anglais ,"", -1);
                }
                $aData['materiaux_francais'] = $materiaux_francais;
                $aData['materiaux_anglais'] = $materiaux_anglais;
                
                $liste_technique = $oOeuvreTechnique->getOeuvreTechniqueByIdOeuvre($aData['id_oeuvre']);
                $technique_francais = "";
                $technique_anglais = "";
                if($liste_technique != 0)
                {
                    foreach($liste_technique as $element)
                    {
                        $technique_francais.= $element['nom_francais'].";";
                        $technique_anglais.= $element['nom_anglais'].";";
                    }
                    $technique_francais = substr_replace($technique_francais ,"", -1);
                    $technique_anglais = substr_replace($technique_anglais ,"", -1);
                }
                $aData['technique_francais'] = $technique_francais;
                $aData['technique_anglais'] = $technique_anglais;
                        
				$this->getFormMod($aData,$liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
			}
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$this->getFormAjout($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur,$listeMsgErreur);
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
			}
		}
		/*else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "miseajour"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
                $this->mettreAJour();
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
			}
		}  */        
		//La liste des oeuvres est affichée.
        else 
        {
			$filtre = "";
			$limit = 500;
			$res = $this->getListeOeuvre($filtre, $limit);
			$oVue = new AdminVue();
			$oVue->afficheOeuvres($res, $msgErreur = "");
		}
	}

	/**
	 * Action à faire après l'envoi des données d'un formulaire.
	 * @access public
	 * @param Requete $requete Le paramètre reçu est un objet Requete.
	 */ 
	public function postAction(Requete $requete){
		//Validation supprimer avec le Checkbox
		if (isset($_POST['supp'])) {
			$msgErreur ="";
			if (isset($_POST['checks']) && is_array($_POST['checks'])) {
				$selected = array();
				$num_checks = count($_POST['checks']);
				foreach ($_POST['checks'] as $key => $value) {
						$selected[] = $value;
				}
			}
			if (empty($selected)){
				$msgErreur = 'Aucune oeuvre sélectionnée';
				$res = $this->getListeOeuvre();
				$oVue = new AdminVue();
				$oVue->afficheOeuvres($res, $msgErreur);
			}

			if($msgErreur == ""){
				$string = $this->ArrayToString($selected);
				$this->supOeuvre($string);
				header("Location:/art-pub-mtl/api/OeuvreAdmin");
			}
		
		}  
        
		// Instanciation des classes pour effectuer la gestion des oeuvres.
        $oCategorie = new Categorie();
        $oTypeSupport = new TypeSupport();
        $oArrondissement = new Arrondissement();
        $oArtiste = new Artiste();
        
        // Obtenir des listes d'informations pour faciliter l'ajout ou la modification d'une oeuvre.
        $liste_categorie = $oCategorie->getListe();
        $liste_support = $oTypeSupport->getListe();
        $liste_arrondissement = $oArrondissement->getListe();
        $liste_artiste = $oArtiste->getListe("",500);
        $msgErreur =""; // Message d'erreur si les informations demandées sont incorrectes.
        $listeMsgErreur = array();
        $listeMsgErreur["titre"] = "";
        $listeMsgErreur["support"] = "";
        $listeMsgErreur["description"] = "";
        $listeMsgErreur["categorie"] = "";
        $listeMsgErreur["artiste"] = "";
        $listeMsgErreur["parc"] = "";
        $listeMsgErreur["coordonnee_latitude"] = "";
        $listeMsgErreur["coordonnee_longitude"] = "";
        $listeMsgErreur["arrondissement"] = "";
		if(isset($requete->url_elements[0]) && (($requete->url_elements[0] == "ajouter") || ($requete->url_elements[0] == "mod"))){
			if(isset($requete->url_elements[1]) && $requete->url_elements[1] == "insert"){
                
                // Validation des données provenant du formulaire.
				if(empty(trim($_POST["titre"]))) {
                    $listeMsgErreur["titre"] = "Vous devez saisir un titre. <br>";
                }
                
                if($_POST["id_support"] == "choix")
                {
                    if(empty(trim($_POST["support_nom_francais"])) && empty(trim($_POST["support_nom_anglais"]))) {
                             $listeMsgErreur["support"] = "Vous devez saisir un type de support ou le choisir dans la liste déroulante.<br>";
                    }                     
                }
                
                if(empty(trim($_POST["description"]))) {
                    $listeMsgErreur["description"] = "Vous devez saisir une description en français. <br>";
                }
                              
                if($_POST["id_categorie"] == "choix") {
                     $listeMsgErreur["categorie"] = "Vous devez choisir une catégorie dans la liste. <br>";
                }
                
                if($_POST["id_artiste"] == "choix") {
                     $listeMsgErreur["artiste"] = "Vous devez choisir un artiste dans la liste. <br>";
                }
                
                if(empty(trim($_POST["parc"])) && empty(trim($_POST["batiment"])) && empty(trim($_POST["adresse"]))) {
					$listeMsgErreur["parc"] = "Vous devez saisir un parc, un bâtiment ou une adresse civique<br>";
                }
                
                if(empty(trim($_POST["coordonnee_latitude"]))) {
                    $listeMsgErreur["coordonnee_latitude"] = "Vous devez saisir une coordonnée pour la latitude.<br>";                               
                }
                
                if(empty(trim($_POST["coordonnee_longitude"]))) {
                    $listeMsgErreur["coordonnee_longitude"] = "Vous devez saisir une coordonnée pour la longitude.<br>";
                }
                
                if($_POST["id_arrondissement"] == "choix") {
                     $listeMsgErreur["arrondissement"] = "Vous devez choisir un arrondissement dans la liste. <br>";
                }               
               
                /*//vérifier si un fichier a été envoyé
                if($_FILES)
                {
                    if($_FILES["fichier_image"]["error"])	
                    {
                        $msgErreur.= "Vous devez choisir un fichier.<br>";
                    }
                }*/              
				// Si le message d'erreur est vide on lance l'ajout ou la modification, sinon on recharge le formulaire de saisie.
				if(($listeMsgErreur["titre"] == "") && ($listeMsgErreur["support"] == "") && ($listeMsgErreur["description"] == "") && ($listeMsgErreur["categorie"] == "") &&
                  ($listeMsgErreur["artiste"] == "") && ($listeMsgErreur["parc"] == "") && ($listeMsgErreur["coordonnee_latitude"] == "") && ($listeMsgErreur["coordonnee_longitude"] == "") && ($listeMsgErreur["arrondissement"] == "")){
                    // Affectation des données à traiter pour un ajout ou une modification.
					$aData = Array();
					foreach($_POST as $cle=>$value){
						$aData[$cle] = $value;
					}

                    if($requete->url_elements[0] == "ajouter")
                    {
                        $this->AjouterData($aData);
                    }
					else if($requete->url_elements[0] == "mod")
                    {
                        $this->ModifierData($aData);
                    }
					header("Location: /art-pub-mtl/api/admin");
                    
				}
				else{
                    if($requete->url_elements[0] == "ajouter")
                    {
                        $this->getFormAjout($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur,$listeMsgErreur);
                    }
					else
                    {
                        $this->getFormMod($_POST,$liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
                    }                   
					
				}

			}

		}
	}
    
	/**
	 * Mise à jour des données selon l'importation d'un fichier JSON.
	 * @access public
	 * 
	 */ 
 	private function mettreAJour()
	{
		$oImportation = new Importation();
		$aOeuvres = $oImportation->importerOeuvre();
		$oImportation->mettreAJour($aOeuvres);
	}    
	
    
	// Section Oeuvres
	protected function getOeuvre($id_oeuvre){
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getOeuvre($id_oeuvre);
		return $aOeuvre;
	}
	
	protected function getListeOeuvre($filtre = "", $limit=20 ){
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->getListe($filtre, $limit);
		return $aOeuvre;
	}

	protected function getFormAjout($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur,$listeMsgErreur){
		$oVue = new AdminVue();
		$oVue->getFormAjoutOeuvre($liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur,$listeMsgErreur);
	}

	protected function getFormMod($aData, $liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur){
		$oVue = new AdminVue();
		$oVue->getFormModifierOeuvre($aData,$liste_artiste,$liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
	}
	
	// Section Supprimer Oeuvres
	protected function supOeuvre($string){
		$oOeuvre = new Oeuvre();
/*        $oArtisteOeuvre = new ArtisteOeuvre();
        $oOeuvreMateriaux = new OeuvreMateriaux();
        $oOeuvreTechnique = new OeuvreTechnique();
        $oArtisteOeuvre->supprimerOeuvreArtiste($string);
        $oOeuvreMateriaux->supprimerOeuvreMateriaux($string);
        $oOeuvreTechnique->supprimerOeuvreTechnique($string);*/
		$aOeuvre = $oOeuvre->deleteOeuvre($string);
	}

	protected function ArrayToString($aData){
			$premier = true;

			foreach($aData as $id){
				if($premier == true){
					$res= "WHERE id_oeuvre = ". $id;
				}
				else{
					$res .=" OR  id_oeuvre = ". $id;
				}
				$premier = false;
			}
			return $res;
	}
    
	protected function AjouterData($aData){

        $oTraitementDonnees = new TraitementDonnees();
        $oMateriaux = new Materiaux();
        $oTechnique = new Technique();
        $oArtisteOeuvre = new ArtisteOeuvre();
        $oOeuvreMateriaux = new OeuvreMateriaux();
        $oOeuvreTechnique = new OeuvreTechnique();
        
        $aData['id_arrondissement'] = intval($aData['id_arrondissement']);
        $aData['id_endroit'] = $oTraitementDonnees->traiterEndroit($aData);

        if($aData['id_support'] == "choix")
        {
            $aData['id_support'] = $oTraitementDonnees->traiterTypeSupport(trim(mb_strtolower($aData['support_nom_francais']), 'UTF-8'),trim(mb_strtolower($aData['support_nom_anglais']), 'UTF-8'));
        }
        
        if(($aData['id_categorie'] != 0) && ($aData['id_support'] != 0) && ($aData['id_endroit'] != 0))
        {
            $aData['id_oeuvre'] = $oTraitementDonnees->traiterOeuvre($aData);
        }

        $donnees = $oMateriaux->verifierMateriauxFrancaisExistant($aData['materiaux_francais']);
        if($donnees == 0)
        {
             if($oMateriaux->ajouterMateriaux($aData['materiaux_francais'],$aData['materiaux_anglais']))
             {
                  $donnees = $oMateriaux->getDernierEnregistrement();
                  $id_materiaux = $donnees['dernier'];
             }            
        }
        else
        {
             $id_materiaux = $donnees['id_materiaux'];
        }
        
        $donnees = $oTechnique->verifierTechniqueFrancaisExistant($aData['technique_francais']);
        if($donnees == 0)
        {
             if($oTechnique->ajouterTechnique($aData['technique_francais'],$aData['technique_anglais']))
             {
                  $donnees = $oTechnique->getDernierEnregistrement();
                  $id_technique = $donnees['dernier'];
             }            
        }
        else
        {
             $id_technique = $donnees['id_technique'];
        }        

        if($aData['id_oeuvre'] > 0)
        {
            $oArtisteOeuvre->ajouterArtisteOeuvre($aData['id_artiste'],$aData['id_oeuvre']);
            $oOeuvreMateriaux->ajouterOeuvreMateriaux($aData['id_oeuvre'],$id_materiaux);
            $oOeuvreTechnique->ajouterOeuvreTechnique($aData['id_oeuvre'],$id_technique);
            /*
            $nomDossier = "../img/oeuvres/no".$aData['id_oeuvre'];
            mkdir($nomDossier, 0777); */
        }
	}
    
    protected function ModifierData($aData)
    {
        $oTraitementDonnees = new TraitementDonnees();
        $oArtisteOeuvre = new ArtisteOeuvre();
        $oOeuvreMateriaux = new OeuvreMateriaux();
        $oOeuvreTechnique = new OeuvreTechnique();
        $oOeuvre = new Oeuvre();
             
        $aData['id_endroit'] = $oTraitementDonnees->traiterEndroit($aData);

        if($aData['id_support'] == "choix")
        {
            $aData['id_support'] = $oTraitementDonnees->traiterTypeSupport(trim(mb_strtolower($aData['support_nom_francais']), 'UTF-8'),trim(mb_strtolower($aData['support_nom_anglais']), 'UTF-8'));
        }
        
        $oOeuvre->ModifierOeuvre($aData);
        
        $tab_id_materiaux = $oTraitementDonnees->traiterMateriaux($aData['materiaux_francais'],$aData['materiaux_anglais']);
        $tab_id_technique = $oTraitementDonnees->traiterTechnique($aData['technique_francais'],$aData['technique_anglais']);
        
        $oArtisteOeuvre->modifierArtisteOeuvre($aData['id_artiste'],$aData['id_oeuvre']);
        for($i = 0; $i < count($tab_id_materiaux); $i++)
        {
            $oOeuvreMateriaux->modifierOeuvreMateriaux($aData['id_oeuvre'],$tab_id_materiaux[$i]);
        }
        for($i = 0; $i < count($tab_id_technique); $i++)
        {
            $oOeuvreTechnique->modifierOeuvreTechnique($aData['id_oeuvre'],$tab_id_technique[$i]);
        }       
        
    }
}
?>