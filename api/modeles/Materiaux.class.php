<?php
/**
 * Class Materiaux
 * 
 * @author Michel Plamondon
 * @version 2.0
 * @update 2019-09-17
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * Cette classe sert à gérer les matériaux dans la base de données. 
 * 
 */
class Materiaux extends Modele {	
	const TABLE_MATERIAUX = "materiaux";
		
	/**
	 * Retourne la liste des matériaux
	 * @access public
	 * @return Array Liste des matériaux contenus dans la base de données.
	 */
	public function getListe() 
	{
		$res = Array();
		$query = "SELECT id_materiaux, nom_francais FROM materiaux order by nom_francais asc";
		if($mrResultat = $this->_db->query($query))
		{
			while($arrond = $mrResultat->fetch_assoc())
			{
				$res[] = $arrond;
			}
		}
		return $res;
	}

 	/**
	 * Ajouter un matériau dans la base de données.
	 * @access public
	 * @param String $nom_francais Chaîne de caractères contenant les données à ajouter dans la base de données.
              String $nom_anglais Chaîne de caractères contenant les données à ajouter dans la base de données.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si le matériau a été ajouté dans la base de données.
	 */ 
    public function ajouterMateriaux($nom_francais,$nom_anglais)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_MATERIAUX ."  (`nom_francais`, `nom_anglais`) VALUES ('".$nom_francais. "', '".$nom_anglais. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
    
  	/**
	 * Vérifie si un matériau existe dans la base de données.
	 * @access public
	 * @param String $nom_francais Chaîne de caractères contenant les données à rechercher dans la base de données.
     * @return Array Tableau contenant les informations sur un matériau.
	 */
    public function verifierMateriauxFrancaisExistant($nom_francais)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_MATERIAUX." where nom_francais = '".$nom_francais."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }
 
  	/**
	 * Récupére le dernier id d'un matériau.
	 * @access public
     * @return Array Tableau contenant le dernier id d'un matériau.
	 */ 
    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_materiaux) as dernier from ". self::TABLE_MATERIAUX))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    } 
	
}
