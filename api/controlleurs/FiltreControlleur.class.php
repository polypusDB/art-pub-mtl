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
 
class FiltreControlleur extends Controlleur 
{
	

	public function getAction(Requete $requete)
	{
        
	}
	/**
	 * POST : 
	 * 		parametres["filtre"] = "adminArtiste" : filtres pour la page /ArtisteAdmin
	 * 		parametres["filtre"] = "adminOeuvre" : filtres pour la page /OeuvreAdmin
	 * 		parametres["filtre"] = "userArtiste" : filtres pour la page /artiste
	 * 		parametres["filtre"] = "userOeuvre" : filtres pour la page /oeuvre
	 */
	public function postAction(Requete $requete){
        
        if($requete->parametres["filtre"] == "adminArtiste"){
            $recherche = $requete->parametres["recherche"];
            $limit = $requete->parametres["limit"];
            $this->filtrerAdminArtiste($recherche, $limit);
        }
        else if($requete->parametres["filtre"] == "adminOeuvre"){
            $recherche = $requete->parametres["recherche"];
            $limit = $requete->parametres["limit"];
            $this->filtrerAdminOeuvre($recherche, $limit);
        }
        else if($requete->parametres["filtre"] == "userArtiste"){
            $recherche = $requete->parametres["recherche"];
            $limit = $requete->parametres["limit"];
            $this->filtrerArtiste($recherche, $limit);
        }
        else if($requete->parametres["filtre"] == "userOeuvre"){
            $arrondissement = $requete->parametres["arrondissements"];
            $materiaux = $requete->parametres["materiaux"];
            $categories = $requete->parametres["categorie"];
            $recherche = $requete->parametres["recherche"];
            $limit = $requete->parametres["oeuvrePresent"];
            $this->filtrerOeuvre($arrondissement, $materiaux, $categories, $recherche, $limit);
        }
	}
    
    /**
     * filtres les oeuvres
     * @param arrondissement    - tableau d'arrondissement
     * @param materiaux         - tableau d'materiaux
     * @param categories        - tableau de categories
     * @param recherche         - string pour les titres des oeuvres
     * @param limit             - int pour limiter le nom de rangée sortis
     * Retourne un tableau d'oeuvres Filtré
     */
    public function filtrerOeuvre($arrondissement, $materiaux, $categories, $recherche, $limit){
        $oFiltre = new Filtre();
        $aFiltre = $oFiltre->OeuvreFiltre($arrondissement, $materiaux, $categories, $recherche, $limit);
    }

    /**
     * filtres les artistes
     * @param recherche         - string pour les nom des artistes
     * @param limit             - int pour limiter le nom de rangée sortis
     * Retourne un tableau d'oeuvres Filtré
     */
    public function filtrerAdminArtiste($recherche, $limit){
        $oFiltre = new Filtre();
        $aFiltre = $oFiltre->filtrerArtisteAdmin($recherche, $limit);
    }

    /**
     * filtres les oeuvres
     * @param arrondissement    - tableau d'arrondissement
     * @param materiaux         - tableau d'materiaux
     * @param categories        - tableau de categories
     * @param recherche         - string pour les titres des oeuvres
     * @param limit             - int pour limiter le nom de rangée sortis
     * Retourne un tableau d'oeuvres Filtré
     */
    public function filtrerAdminOeuvre($recherche, $limit){
        $oFiltre = new Filtre();
        $aFiltre = $oFiltre->filtrerOeuvreAdmin($recherche, $limit);
    }

    /**
     * filtres les artistes
     * @param recherche         - string pour les nom des artistes
     * @param limit             - int pour limiter le nom de rangée sortis
     * Retourne un tableau d'oeuvres Filtré
     */
    public function filtrerArtiste($recherche, $limit){
        $oFiltre = new Filtre();
        $aFiltre = $oFiltre->filtrerArtiste($recherche, $limit);
    }
	
	
}
?>
