<?php
/**
 * Class FiltreControlleur
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

class UsagerControlleur extends Controlleur 
{
	/**
	 * GET : 
	 * 		/connection : 	1- si l'utilisateur est connecté on le déconnecte
	 * 					  	2- si l'utilisateur n'est pas connecté on l'ammene au formullaire de connection / inscription 
	 */
	public function getAction(Requete $requete)
	{

        // var_dump($_SESSION["utilisateur"]);
        if($_SESSION["utilisateur"]["id_usager"] == $requete->url_elements[0]){
            $usager = $this->getUsager($requete->url_elements[0]);
            $this->afficheUsager($usager);
        }
        else{
            header("Location: /art-pub-mtl/api");
        }
    }
    
    protected function getUsager($id){
        $oUsagers = new Usagers();
        $aUsagers = $oUsagers->getUsager($id);
        return $aUsagers;
    }

    protected function afficheUsager($usager){
        $oVue = new Vue();
        $oVue->AfficherUsager($usager);
    }
}
?>