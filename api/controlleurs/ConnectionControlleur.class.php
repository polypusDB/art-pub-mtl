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
			$oVue = new Vue();
			$msg= "";			
			$oVue->afficherFormConnexion($msg);
			
		}


		
	}

	public function postAction(Requete $requete){
		
		if(isset($requete->url_elements[0])&& $requete->url_elements[0] ="login")	// Normalement l'id de l'oeuvre 
		{
			if(isset($_POST["user"]) && isset($_POST["mdp"])){
				if(trim($_POST["user"]) != "" && trim($_POST["mdp"])){
					$mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
					$this->connection($_POST["user"], $mdp);					
				}
				else{
					$msg = "les champs requis ne sont pas remplis";
					$oVue = new Vue();
					$oVue->afficherFormConnexion($msg);
				}
			}
			else{
				echo "vous n'arrivez pas d'un formulaire";
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
			$msg = "mauvaise combinaison mot de passe et nom d'usagé";
			$oVue = new Vue();
			$oVue->afficherFormConnexion($msg);
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
		else{
			echo "je ne suis pas un admin";
		}
	}
}
?>