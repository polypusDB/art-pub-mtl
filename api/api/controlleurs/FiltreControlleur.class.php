<?php
/**
 * Class FiltreControlleur
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

 
 
class FiltreControlleur extends Controlleur 
{
	

	public function getAction(Requete $requete)
	{
        echo "filtre";
	}

	public function postAction(Requete $requete){

        
        // var_dump($requete->parametres);
        $arrondissement = $requete->parametres["arrondissements"];
        $materiaux = $requete->parametres["materiaux"];
        $categories = $requete->parametres["categorie"];
        $recherche = $requete->parametres["recherche"];
        $limit = $requete->parametres["oeuvrePresent"];

        // echo json_encode($limit);



        $this->filtrerOeuvre($arrondissement, $materiaux, $categories, $recherche, $limit);



	}
    
    
    public function filtrerOeuvre($arrondissement, $materiaux, $categories, $recherche, $limit){
        $oFiltre = new Filtre();
        $aFiltre = $oFiltre->OeuvreFiltre($arrondissement, $materiaux, $categories, $recherche, $limit);
    }
	
	
}
?>
