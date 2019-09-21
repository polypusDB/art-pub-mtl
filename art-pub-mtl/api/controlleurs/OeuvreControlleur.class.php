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
        $oCategorie = new Categorie();
        $oTypeSupport = new TypeSupport();
        $oArrondissement = new Arrondissement();
        $liste_categorie = $oCategorie->getListe();
        $liste_support = $oTypeSupport->getListe();
        $liste_arrondissement = $oArrondissement->getListe();
        $msgErreur ="";

		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// Normalement l'id de l'oeuvre 
		{
			$id_oeuvre = (int)$requete->url_elements[0];            
			$res = $this->getOeuvre($id_oeuvre);
			$oVue = new vue;
			$oVue->afficheOeuvre($res);
		}
		else if(isset($requete->url_elements[0]) == "sup" && $requete->url_elements[0] == "sup"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$res = $this->supOeuvre($requete->url_elements[1]);
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
				
			}
		}
		else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["type_acces"] == "admin"){
				$this->getFormAjout($liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
			}
			else{
				echo "vous devez etre connecté en tant qu'admin";
				
			}
		}
        else 	// La liste des oeuvres est a affiché
        {
			$res = $this->getListeOeuvre();
			$oVue = new vue;
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
		$oOeuvre = new Oeuvre();
		$aOeuvre = $oOeuvre->deleteOeuvre($id_oeuvre);
		header("Location:/art-pub-mtl/api/oeuvre");
	}
	
	public function postAction(Requete $requete){
        $oCategorie = new Categorie();
        $oTypeSupport = new TypeSupport();
        $oArrondissement = new Arrondissement();
        $liste_categorie = $oCategorie->getListe();
        $liste_support = $oTypeSupport->getListe();
        $liste_arrondissement = $oArrondissement->getListe();
        $msgErreur ="";
		if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "ajouter"){
			if(isset($requete->url_elements[1]) && $requete->url_elements[1] == "insert"){
				

				if(empty(trim($_POST["titre"])))
                    $msgErreur.= "Vous devez saisir un titre. <br>";
                if(empty(trim($_POST["dimension"])))
                    $msgErreur.= "Vous devez saisir une dimension. <br>";                 
                if(empty(trim($_POST["description"])))
                    $msgErreur.= "Vous devez saisir une description. <br>";
                if(empty(trim($_POST["coordonnee_latitude"])))
                    $msgErreur.= "Vous devez saisir une coordonnée pour la latitude.<br>";                                   
                if(empty(trim($_POST["coordonnee_longitude"])))
                    $msgErreur.= "Vous devez saisir une coordonnée pour la longitude.<br>";                         
                if(empty(trim($_POST["parc"])) && empty(trim($_POST["batiment"])) && empty(trim($_POST["adresse"])))
					$msgErreur.= "Vous devez saisir un parc, un bâtiment ou une adresse civique<br>";

				// Si le message d'erreur est vide on lance l'ajout, sinon on affiche le message
				if($msgErreur == ""){
					$aData = Array();
					foreach($_POST as $cle=>$value){
						$aData[$cle] = $value;
					}

					$this->AjouterData($aData);
					header("Location: /art-pub-mtl/api/oeuvre");
				}
				else{
					$this->getFormAjout($liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
				}

			}

		}
	}	

	protected function getFormAjout($liste_categorie,$liste_support,$liste_arrondissement,$msgErreur){
		$oVue = new Vue();
		$oVue->getFormAjoutOeuvre($liste_categorie,$liste_support,$liste_arrondissement,$msgErreur);
	}    
    
	protected function AjouterData($aData){

		$oOeuvre = new Oeuvre();
        $oEndroit = new Endroit();
        $oMateriaux = new Materiaux();
        $oOeuvreMateriaux = new OeuvreMateriaux();
        $oOeuvreTechnique = new OeuvreTechnique();
        $oTechnique = new Technique();
        $endroit = $oEndroit->ajouterEndroit($aData['parc'], $aData['batiment'], $aData['adresse'], $aData['coordonnee_latitude'], $aData['coordonnee_longitude'],$aData['id_arrondissement']);
        $dernierEndroit = $oEndroit->getDernierEnregistrement();
        $aData['id_endroit'] = $dernierEndroit['dernier'];
		$oOeuvre->ajouterOeuvre($aData);
        $dernierOeuvre = $oOeuvre->getDernierEnregistrement();
        // Faire le lien entre l'oeuvre et l'artiste.
        
       /* $tabTechnique = explode(';',$aData['technique']);
        foreach($tabTechnique as $technique)
        {
            echo $technique;
            $donnees = $oTechnique->verifierTechniqueFrancaisExistant(trim($technique));
            if(count($donnees) == 0)
            {
                $oTechnique->ajouterTechnique(trim($technique)," ");
               
                $donnees = $oTechnique->verifierTechniqueFrancaisExistant(trim($technique));
            var_dump($dernierOeuvre);
            var_dump($donnees);
            die(); 
            }
            $oOeuvreTechnique->ajouterOeuvreTechnique($dernierOeuvre['id_oeuvre'],$donnees['id_technique']);
            */       
	}    
}
?>