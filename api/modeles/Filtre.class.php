<?php
/**
 * Class Oeuvre
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2014-09-11
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * 
 * 
 */
class Filtre extends Modele {		
	/**
	 * Retourne les information de l'utilisateur connecté
	 * @access public
	 * @return Array
	 */
	
    public function OeuvreFiltre($arron, $materiaux, $categories, $recherche, $limit){


        $DerItem = count($arron);
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

        foreach($arron as $arr){
            $elemAvant = true;
            $arr = $arr->id;
            if(++$i === $DerItem){
                $res .= " a.id_arrondissement = ". $arr;
            }
            else{
                $res .= " OR  a.id_arrondissement = ". $arr;
            }

        }


        
        $DerItemMat = count($materiaux);
        $y = 0;

        foreach($materiaux as $mat){
            if($elemAvant == true){
                $res .= " AND ";
                $elemAvant == false;
            }
            $mat = $mat->id_mat;
            if(++$y === $DerItemMat){
                $res .= " om.id_materiaux = ". $mat;
            }
            else{
                $res .= " OR  om.id_materiaux = ". $mat;
            }
            $elemMatAvant = true;
        }


        $DerItemCat = count($categories);
        $z = 0;
        foreach($categories as $cat){
            if($elemMatAvant == true || $elemAvant == true){
                $res .= " AND ";
                $elemMatAvant = false;
                $elemAvant = false;
            }
            $cat = $cat->id_cat;
            if(++$z === $DerItemCat){
                $res .= " oeuvre.id_categorie = ". $cat;
            }
            else{
                $res .= " OR  oeuvre.id_categorie = ". $cat;
            }
            $elemCatAvant = true;
        }


        // ICI NEW ÉTAPE
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


        // echo json_encode($res);



        $oOeuvre = new Oeuvre();
        $aOeuvre = $oOeuvre->getListe($res, $limit);

        $aOeuvre = json_encode($aOeuvre);
        echo $aOeuvre;

        
    }

    public function filtrerArtisteAdmin($rec = "", $limit = 500){
        
        if($rec != ""){
            $res = "WHERE ";
            $res .= "artiste.nom like '%$rec%' OR artiste.prenom like '%$rec%' OR artiste.nom_collectif like '%$rec%'";

        }
        $oArtiste = new Artiste();
        $aArtiste = $oArtiste->getListe($res, $limit);
        echo json_encode($aArtiste);
    }

    public function filtrerOeuvreAdmin($rec , $limit){
        if($rec != ""){
            $res = "WHERE ";
            $res .= " oeuvre.titre like'%$rec%'";

        }
        $oOeuvre = new Oeuvre();
        $aOeuvre = $oOeuvre->getListe($res , $limit);
        echo json_encode($aOeuvre);
    }


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