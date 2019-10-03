<?php
/**
 * Class AdminControlleur
 * Gère la page d'accueil
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 /*
 * TODO : Commenter selon les standards du département.
 *
 */

 
 
class AdminControlleur extends Controlleur 
{
	
	// GET : 
	
	public function getAction(Requete $requete)
	{
		if($_SESSION["utilisateur"]["type_acces"] == "admin"){
			$oVue = new Vue();
			$oVue->afficheAccueilAdmin();
		}
		else{
			echo "tu n'est pas un admin";
		}


	}
	
	
}
?>