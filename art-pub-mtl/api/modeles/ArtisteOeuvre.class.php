<?php
/**
 * Class ArtisteOeuvre
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
class ArtisteOeuvre extends Modele {	
	const TABLE_ARTISTEOEUVRE = "artiste_oeuvre";
    
    public function ajouterArtisteOeuvre($id_artiste,$id_oeuvre)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_ARTISTEOEUVRE ."  (`id_artiste`, `id_oeuvre`) VALUES ('".$id_artiste. "', '".$id_oeuvre. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
	
}