<?php
/**
 * Class ConnectionControlleur
 * Gère les requêtes de connection
 * 
 * @author Saul Turbide
 * @version 1.0
 * @update 2019-08-12
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 


 

class ConnectionControlleur extends Controlleur 
{
	

	
	public function getAction(Requete $requete)
	{
		if(isset($_SESSION["utilisateur"])){
			$this->deconnection();
			header("Location: /art-pub-mtl/api");
		}
		else{ 
			$action = "connexion";
			$oVue = new Vue();
			$msg= "";			
			$oVue->afficherFormConnexion($msg, $action);
			
		}


		
	}

	public function postAction(Requete $requete){
		
		if(isset($requete->url_elements[0])&& $requete->url_elements[0] =="login")
		{
			echo "<br>";
			echo $requete->url_elements[0];
			if(isset($_POST["user"]) && isset($_POST["mdp"])){
				if(trim($_POST["user"]) != "" && trim($_POST["mdp"])){
					$this->connection($_POST["user"]);	
									
				}
				else{
					$msg = "les champs requis ne sont pas remplis";
					$action = "connexion";
					$oVue = new Vue();
					$oVue->afficherFormConnexion($msg, $action);
				}
			}
			else{
				echo "vous n'arrivez pas d'un formulaire";
			}
		}
		else if(isset($requete->url_elements[0])&& $requete->url_elements[0] =="inscription"){
			
			$res = $this->inscription($_POST);
			if($res == true){
				$this->connection();
			}
			else{
				$action = "inscription";
				$msg = "Le nom sélectionné est déjà utilisé!";
				$oVue = new Vue();
				$oVue->afficherFormConnexion($msg, $action);
			}
		}
	}

	protected function deconnection(){
		session_destroy();
	}

	protected function connection(){
		$oConnection = new Connection();
		$utilisateur = $oConnection->getConnectionUser($_POST["user"], $_POST["mdp"]);
		if($utilisateur == false){
			$action = "connexion";
			$msg = "Mauvaise combinaison mot de passe et nom d'usager";
			$oVue = new Vue();
			$oVue->afficherFormConnexion($msg, $action);
		}
		else{
			$_SESSION["utilisateur"] = $utilisateur;
			
			$this->detecConnexion($utilisateur);
		}
		
	}

	protected function detecConnexion($user){
		if($user["type_acces"] == "admin"){
			header("location: /art-pub-mtl/api/admin");
		}
		else if($user["type_acces"] == "usager"){
			header("location: /art-pub-mtl/api");
		}
	}

	protected function inscription($aData){
		$oConnection = new Connection();
		$res = $oConnection->inscription($aData);
		return $res;
	}
}
?>