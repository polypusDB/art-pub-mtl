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
			// echo "je ne suis pas connecte.";
			
			$oVue->afficherFormConnexion();
			
		}


		
	}

	public function postAction(Requete $requete){
		
		if(isset($requete->url_elements[0])&& $requete->url_elements[0] ="login")	// Normalement l'id de l'oeuvre 
		{
			if(isset($_POST["user"]) && isset($_POST["mdp"])){
				if(trim($_POST["user"]) != "" && trim($_POST["mdp"])){
					$this->connection($_POST["user"], $_POST["mdp"]);
					header("Location: /art-pub-mtl/api");
				}
				else{
					echo "les champs requis ne sont pas remplis";
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
		$_SESSION["utilisateur"] = $utilisateur;
	}
}
?>