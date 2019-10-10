<?php
/**
 * Class AccueilControlleur
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

 
 
class ParcoursControlleur extends Controlleur 
{
	
	// GET : 
	
	public function getAction(Requete $requete)
	{
		$oVue = new Vue();
		$oVue->afficheParcours();				
	}
	
	
}
?>