<?php
/**
 * Class filtres
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2014-09-11
 * @update 2019-10-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * Cette classe sert à gérer les oeuvres dans la base de données. 
 * 
 */
class Filtre extends Modele {		
	/**
	 * Crée une string qui est ajouter au bout du select dans le modele oeuvre pour filtrer
	 * @access public
	 * @return Array
     * @param arron arrondissements pour filtrer
     * @param materiaux materiaux pour filtrer
     * @param categories categories pour filtrer
     * @param recherche recherche par titre
     * @param limit limit le nombre d'objet retourner
	 */
    public function OeuvreFiltre($arron, $materiaux, $categories, $recherche, $limit=20){

        /**
         * détecte les éléments avant pour rajouter des éléments "AND OR ()"
         */
        $elemAvant = false;
        $elemMatAvant = false;
        $elemCatAvant = false;
        $elemRecherche = false;

        $presArr = false;
        $presMat = false;
        $presCat = false;
        $presRec = false;

        $res= "WHERE";
        $i = 0;
        // arrondissement
        foreach($arron as $arr){
            $elemAvant = true;
            $arr = $arr->id;
            if(++$i === 1){
                $res .= "( a.id_arrondissement = ". $arr;
            }
            else{
                $res .= " OR  a.id_arrondissement = ". $arr;
            }

        }
        if($elemAvant == true){
            $res .= ")";
        }

        // materiaux
        $y = 0;
        foreach($materiaux as $mat){
            if($elemAvant == true){
                $res .= " AND ";
                $elemAvant == false;
            }
            $mat = $mat->id_mat;
            if(++$y === 1){
                $res .= "( om.id_materiaux = ". $mat;
            }
            else{
                $res .= " OR  om.id_materiaux = ". $mat;
            }
            $elemMatAvant = true;
        }

        if($elemMatAvant == true){
            $res .= ")";
        }

        // catégories
        $z = 0;
        foreach($categories as $cat){
            if($elemMatAvant == true || $elemAvant == true){
                $res .= " AND ";
                $elemMatAvant = false;
                $elemAvant = false;
            }
            $cat = $cat->id_cat;
            if(++$z === 1){
                $res .= "( oeuvre.id_categorie = ". $cat;
            }
            else{
                $res .= " OR  oeuvre.id_categorie = ". $cat;
            }
            $elemCatAvant = true;
        }
        if($elemCatAvant == true){
            $res .= ")";
        }

        // recherche
        if($recherche != ""){
            $elemRecherche = true;
            if($elemCatAvant == true || $elemMatAvant == true || $elemAvant == true){
                $res .= " AND ";
                $elemMatAvant = false;
                $elemCatAvant = false;
                $elemAvant = false;
            }
            $res .= " oeuvre.titre LIKE '%$recherche%'";
        }

        if( $elemAvant == false && $elemMatAvant == false && $elemCatAvant == false && $elemRecherche == false){
            $res = "";
        }

        $oOeuvre = new Oeuvre();
        $aOeuvre = $oOeuvre->getListe($res, $limit);

        echo json_encode($aOeuvre);
    }

    	/**
	 * Crée une string qui est ajouter au bout du select dans le modele oeuvre pour filtrer
	 * @access public
	 * @return Array
     * @param rec recherche par titre
     * @param limit limit le nombre d'objet retourner
	 */
    public function filtrerArtisteAdmin($rec = "", $limit = 500){
        
        if($rec != ""){
            $res = "WHERE ";
            $res .= "artiste.nom like '%$rec%' OR artiste.prenom like '%$rec%' OR artiste.nom_collectif like '%$rec%'";

        }
        else{
            $res = "";
        }
        $oArtiste = new Artiste();
        $aArtiste = $oArtiste->getListe($res, $limit);
        echo json_encode($aArtiste);
    }
    /**
	 * Crée une string qui est ajouter au bout du select dans le modele oeuvre pour filtrer
	 * @access public
	 * @return Array
     * @param rec recherche par titre
     * @param limit limit le nombre d'objet retourner
	 */
    public function filtrerOeuvreAdmin($rec , $limit){
        if($rec != ""){
            $res = "WHERE ";
            $res .= " oeuvre.titre like'%$rec%'";

        }
        else{
            $res = "";
        }
        $oOeuvre = new Oeuvre();
        $aOeuvre = $oOeuvre->getListe($res , $limit);
        echo json_encode($aOeuvre);
    }

    /**
	 * Crée une string qui est ajouter au bout du select dans le modele oeuvre pour filtrer
	 * @access public
	 * @return Array
     * @param rec recherche par titre
     * @param limit limit le nombre d'objet retourner
	 */
    public function filtrerArtiste($rec, $limit){
        if($rec != ""){
            $res = "WHERE ";
            $res .= "artiste.nom like '%$rec%' OR artiste.prenom like '%$rec%' OR artiste.nom_collectif like '%$rec%'";
        }
        else{
            $res = "";
        }
        $oArtiste = new Artiste();
        $aArtiste = $oArtiste->getListe($res, $limit);
        echo json_encode($aArtiste);
    }


    
}




?>