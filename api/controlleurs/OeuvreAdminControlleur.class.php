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
				$this->getFormAjout();
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
			$oVue->afficheOeuvres($res, $msgErreur = "");
		}		
		
		
	}

	public function postAction(Requete $requete)
	{
		// var_dump($requete->url_elements[0]);
		// if (isset($requete->url_elements[0]) && $requete->url_elements[0] == "mod"){
		// 	// modification de l'oeuvre ici!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		// }

		
		//Validation supprimer avec le Checkbox
		if (isset($_POST['supp'])) {
			$msgErreur ="";
			if (isset($_POST['checks']) && is_array($_POST['checks'])) {
				$selected = '';
				$num_checks = count($_POST['checks']);
				$current = 0;
				foreach ($_POST['checks'] as $key => $value) {
					if ($current != $num_checks-1)
						$selected .= $value.', ';
					else
						$selected .= $value;
					$current++;
				}
			}
			if (empty($selected)){
				$msgErreur = 'Aucune oeuvre sélectionnée';
				$res = $this->getListeOeuvre();
				$oVue = new AdminVue();
				$oVue->afficheOeuvres($res, $msgErreur);
			}

			if($msgErreur == ""){
				echo 'Sélectionnée: '.$selected;
			}
		
		}    
		
	}
	
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

	protected function getFormAjout(){
		$oVue = new AdminVue();
		$oVue->getFormAjoutOeuvre();
	}

	protected function getFormMod(){
		$oVue = new AdminVue();
		$oVue->getFormModifierOeuvre();
	}
	
	
	
}
?>