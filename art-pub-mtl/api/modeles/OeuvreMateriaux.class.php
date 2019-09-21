<?php
/**
 * Class OeuvreMateriaux
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
class OeuvreMateriaux extends Modele {	
	const TABLE_OEUVRE_MATERIAUX = "oeuvre_materiaux";
    
    public function ajouterOeuvreMateriaux($id_oeuvre,$id_materiaux)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_OEUVRE_MATERIAUX ."  (`id_oeuvre`, `id_materiaux`) VALUES ('".$id_oeuvre. "', '".$id_materiaux. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
	
}