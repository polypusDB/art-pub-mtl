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
			echo "je suis connecté";
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
					$oConnection = new Connection();
					$utilisateur = $oConnection->getConnectionUser($_POST["user"], $_POST["mdp"]);
					// var_dump($utilisateur);
					
					$_SESSION["utilisateur"] = $utilisateur;
					// var_dump($_SESSION["utilisateur"]["type_acces"]);
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
}
?>