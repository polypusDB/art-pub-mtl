<?php
/**
 * Class Controlleur
 * Classe abstraite des controlleurs de ressources
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2016-11-02
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 /*

 *
 */

abstract class Controlleur 
{
	
	private function erreur()
	{
		//header('HTTP/1.1 400 Bad Request');
		http_response_code(400);
		echo "Erreur de requête\n\r";
		//var_dump($_GET);
		
	}
	
		
}
?>