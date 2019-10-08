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
	
    public function OeuvreFiltre($arron, $materiaux){
        
        $res= "WHERE a.id_arrondissement = ";
        $i = 0;
        $DerItem = count($arron);
        foreach($arron as $arr){
            $arr = $arr->id;
            if(++$i === $DerItem){
                $res .= $arr;
            }
            else{
                $res .= " OR  a.id_arrondissement = ". $arr;
            }
        }

        $oOeuvre = new Oeuvre();
        $aOeuvre = $oOeuvre->getListe($res);

        $aOeuvre = json_encode($aOeuvre);
        echo $aOeuvre;

    }
    
}




?>