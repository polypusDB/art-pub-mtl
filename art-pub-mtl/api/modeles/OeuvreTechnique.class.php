<?php
/**
 * Class OeuvreTechnique
 * 
 * @author Michel Plamondon
 * @version 2.0
 * @update 2019-09-17
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * 
 * 
 */
class OeuvreTechnique extends Modele {	
	const TABLE_OEUVRE_TECHNIQUE = "oeuvre_technique";
    
    public function ajouterOeuvreTechnique($id_oeuvre,$id_technique)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_OEUVRE_TECHNIQUE ."  (`id_oeuvre`, `id_technique`) VALUES ('".$id_oeuvre. "', '".$id_technique. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
	
}