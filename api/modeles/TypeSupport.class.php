<?php
/**
 * Class TypeSupport
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
class TypeSupport extends Modele {	
	const TABLE_TYPE_SUPPORT = "type_support";
		
	/**
	 * Retourne la liste des catégories
	 * @access public
	 * @return Array
	 */
	public function getListe() 
	{
		$res = Array();
		$query = "select * from ". self::TABLE_TYPE_SUPPORT;
		if($mrResultat = $this->_db->query($query))
		{
			while($arrond = $mrResultat->fetch_assoc())
			{
				$res[] = $arrond;
			}
		}
		return $res;
	}
    
    public function ajouterTypeSupport($nom_francais,$nom_anglais)
    {

		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_TYPE_SUPPORT ."  (`nom_francais`, `nom_anglais`) VALUES ('".$nom_francais. "', '".$nom_anglais. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
    
    public function verifierTypeSupportFrancaisExistant($nom_francais)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_TYPE_SUPPORT." where nom_francais = '".$nom_francais."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }

    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_support) as dernier from ". self::TABLE_TYPE_SUPPORT))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    }
}
