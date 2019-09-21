<?php
/**
 * Class Technique
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
class Technique extends Modele {	
	const TABLE_TECHNIQUE = "technique";
		
	/**
	 * Retourne la liste des techniques
	 * @access public
	 * @return Array
	 */
	public function getListe() 
	{
		$res = Array();
		$query = "select * from ". self::TABLE_TECHNIQUE;
		if($mrResultat = $this->_db->query($query))
		{
			while($arrond = $mrResultat->fetch_assoc())
			{
				$res[] = $arrond;
			}
		}
		return $res;
	}
    
    public function ajouterTechnique($nom_francais,$nom_anglais)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_TECHNIQUE ."  (`nom_francais`, `nom_anglais`) VALUES ('".$nom_francais. "', '".$nom_anglais. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
    
    public function verifierTechniqueFrancaisExistant($nom_francais)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_TECHNIQUE." where nom_francais = '".$nom_francais."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }
    
//    public function getDernierEnregistrement()
//    {
//		$res = Array();
//		if($mrResultat = $this->_db->query("select max(id_oeuvre) as dernier from ". self::TABLE_TECHNIQUE))
//		{
//			$res = $mrResultat->fetch_assoc();
//		}
//		return $res;        
//    }  
}
