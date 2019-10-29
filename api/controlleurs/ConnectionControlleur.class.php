<?php
/**
 * Class ConnectionControlleur
 * Gère la page connection
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */


 

class ConnectionControlleur extends Controlleur 
{
	/**
	 * GET : 
	 * 		/connection : 	1- si l'utilisateur est connecté on le déconnecte
	 * 					  	2- si l'utilisateur n'est pas connecté on l'ammene au formullaire de connection / inscription 
	 */
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

	/**
	 * POST 
	 * 		/inscription/login			- on montre le formulaire de connexion
	 * 		/inscription/inscription 	- on montre le formullaire d'inscription
	 */

	public function postAction(Requete $requete){
		/**
		 * les "actions" sont utilisé pour savoir quelle formulaire caché selon l'endroits d'ou on viens
		 */
		if(isset($requete->url_elements[0])&& $requete->url_elements[0] =="login")
		{
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

	/**
	 * Déconnexion
	 */
	protected function deconnection(){
		session_destroy();
	}

	/**
	 * Connexion de l'usager à son compte
	 */
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
	/**
 	*	Redirection après la connexion selon le type d'acces de la personne connecté 
 	*/
	protected function detecConnexion($user){
		if($user["type_acces"] == "admin"){
			header("location: /art-pub-mtl/api/admin");
		}
		else if($user["type_acces"] == "usager"){
			header("location: /art-pub-mtl/api");
		}
	}

	/**
	 * Envoie les informations pour l'inscription au modele connexion
	 * @param aData - information de l'usager sur le formulaire d'inscription
	 */
	protected function inscription($aData){
		$oConnection = new Connection();
		$res = $oConnection->inscription($aData);
		return $res;
	}
}
?>