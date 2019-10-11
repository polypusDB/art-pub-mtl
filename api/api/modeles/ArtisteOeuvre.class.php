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
 * Cette classe sert à faire le lien entre un artiste et une oeuvre. 
 * 
 */
class ArtisteOeuvre extends Modele {	
	const TABLE_ARTISTEOEUVRE = "artiste_oeuvre";
    
 	/**
	 * Ajouter un lien entre un artiste et une oeuvre dans la base de données.
	 * @access public
	 * @param int $id_artiste Identifiant de l'artiste contenant les données à ajouter dans la base de données.
     * @param int $id_oeuvre Identifiant de l'oeuvre contenant les données à ajouter dans la base de données.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si lien entre un artiste et une oeuvre a été ajouté dans la base de données.
	 */   
    public function ajouterArtisteOeuvre($id_artiste,$id_oeuvre)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_ARTISTEOEUVRE ."  (`id_artiste`, `id_oeuvre`) VALUES ('".$id_artiste. "', '".$id_oeuvre. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
    
  	/**
	 * Récupére le dernier id d'un artiste.
	 * @access public
     * @param int $id_oeuvre Identifiant de l'oeuvre contenant les données à ajouter dans la base de données.
     * @return Array Tableau le dernier id d'un artiste.
	 */ 
    public function getDernierEnregistrement($id_oeuvre)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_artiste) as dernier from ". self::TABLE_ARTISTEOEUVRE ." where id_oeuvre =". $id_oeuvre))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    } 
    
    
    public function modifierArtisteOeuvre($id_artiste, $id_oeuvre)
    {
        $resQuery = false;
        
		$query = "UPDATE ". self::TABLE_ARTISTEOEUVRE ."
        id_artiste = ".$id_artiste."
		WHERE id_oeuvre = '$id_oeuvre'";

		$resQuery = $this->_db->query($query); 
        
		return $resQuery;        
    }
}