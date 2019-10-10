<?php
/**
 * Class Materiaux
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2016-11-25
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * 
 * 
 */
class Categorie extends Modele {	
	const TABLE_CATEGORIE = "categorie";
		
	/**
	 * Retourne la liste des catégories
	 * @access public
	 * @return Array
	 */
	public function getListe() 
	{
		$res = Array();
		$query = "SELECT id_categorie, nom_francais FROM categorie";
		if($mrResultat = $this->_db->query($query))
		{
			while($categorie = $mrResultat->fetch_assoc())
			{
				$res[] = $categorie;
			}
		}
		return $res;
	}
    
    public function ajouterCategorie($nom_francais,$nom_anglais)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_CATEGORIE ."  (`nom_francais`, `nom_anglais`) VALUES ('".$nom_francais. "', '".$nom_anglais. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
    
    public function verifierCategorieFrancaisExistant($nom_francais)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_CATEGORIE." where nom_francais = '".$nom_francais."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }
	
}




?>