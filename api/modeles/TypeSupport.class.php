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
 *  Cette classe sert à gérer les types de support dans la base de données.
 * 
 */
class TypeSupport extends Modele {	
	const TABLE_TYPE_SUPPORT = "type_support";
		
	/**
	 * Retourne la liste des types de support
	 * @access public
	 * @return Array Liste des types de support contenus dans la base de données.
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

 	/**
	 * Ajouter un type de support dans la base de données.
	 * @access public
	 * @param String $nom_francais Chaîne de caractères représentant le nom du type de support en français.
     * @param String $nom_anglais Chaîne de caractères représentant le nom du type de support en anglais.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si la technique a été ajoutée dans la base de données.
	 */ 
    public function ajouterTypeSupport($nom_francais,$nom_anglais)
    {

		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_TYPE_SUPPORT ."  (`nom_francais`, `nom_anglais`) VALUES ('".$nom_francais. "', '".$nom_anglais. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
    
 	/**
	 * Vérifie si un type de support existe dans la base de données.
	 * @access public
	 * @param String $nom_francais Chaîne de caractères contenant le nom en français du type de support.
     * @return Array Tableau contenant les informations sur un type de support.
	 */
    public function verifierTypeSupportFrancaisExistant($nom_francais)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_TYPE_SUPPORT." where nom_francais = '".$nom_francais."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }

  	/**
	 * Récupére le dernier id d'un type de support.
	 * @access public
     * @return Array Tableau contenant le dernier id d'un type de support.
	 */    
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
