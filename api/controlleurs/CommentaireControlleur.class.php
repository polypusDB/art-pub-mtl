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

 
 
class CommentaireControlleur extends Controlleur 
{
	

	public function getAction(Requete $requete)
	{
        echo "Commentaire";
	}

	public function postAction(Requete $requete){
        
		var_dump($requete->parametres);
	}
	
	
	
}
?>