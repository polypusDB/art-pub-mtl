<?php
/**
 * Class AccueilControlleur
 * Gère la page d'accueil
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 /*
 * ACTION : Dirige l'utilisateur vers la page d'accueil.
 *
 */

 
 
class AccueilControlleur extends Controlleur 
{
	
	// GET : api/ - page d'accueil
	public function getAction(Requete $requete)
	{
		$oVue = new Vue();
		$oVue->afficheAccueil();				
	}
	
	
}
?>