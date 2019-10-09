<?php
/**
 * Class Arrondissement
 * 
 * @author Jonathan Martel modifié par Michel Plamondon
 * @version 2.0
 * @update 2019-09-12
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * 
 * 
 */
class Arrondissement extends Modele {	
	const TABLE_ARRONDISSEMENT = "arrondissement";
		
	/**
	 * Retourne la liste des arrondissement
	 * @access public
	 * @return Array
	 */
	public function getListe() 
	{
		$res = Array();
		$query = "select * from ". self::TABLE_ARRONDISSEMENT;
		if($mrResultat = $this->_db->query($query))
		{
			while($arrond = $mrResultat->fetch_assoc())
			{
				$res[] = $arrond;
			}
		}
		return $res;
	}
    
    public function ajouterArrondissement($nom)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_ARRONDISSEMENT ."  (`nom`) VALUES ('".$nom. "')";
        $resultat = $this->_db->query($query); 
		return $resultat;
    }
    
    public function verifierArrondissementExistant($nom)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ARRONDISSEMENT." where nom = '".$nom."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }	
    
    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_arrondissement) as dernier from ". self::TABLE_ARRONDISSEMENT))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    }    
}
?>