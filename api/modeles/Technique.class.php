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
 *  Cette classe sert à gérer les techniques dans la base de données.
 * 
 */
class Technique extends Modele {	
	const TABLE_TECHNIQUE = "technique";
		
	/**
	 * Retourne la liste des techniques
	 * @access public
	 * @return Array Liste des techniques contenus dans la base de données.
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
 
 	/**
	 * Ajouter une technique dans la base de données.
	 * @access public
	 * @param String $nom_francais Chaîne de caractères représentant le nom de la technique en français.
     * @param String $nom_anglais Chaîne de caractères représentant le nom de la technique en anglais.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si la technique a été ajoutée dans la base de données.
	 */ 
    public function ajouterTechnique($nom_francais,$nom_anglais)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_TECHNIQUE ."  (`nom_francais`, `nom_anglais`) VALUES ('".$nom_francais. "', '".$nom_anglais. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
    
  
  	/**
	 * Vérifie si une technique existe dans la base de données.
	 * @access public
	 * @param String $nom_francais Chaîne de caractères contenant le nom en français de la technique.
     * @return Array Tableau contenant les informations sur une technique.
	 */ 
    public function verifierTechniqueFrancaisExistant($nom_francais)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_TECHNIQUE." where nom_francais = '".$nom_francais."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }

  	/**
	 * Récupére le dernier id d'une technique.
	 * @access public
     * @return Array Tableau contenant le dernier id d'une technique.
	 */     
    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_technique) as dernier from ". self::TABLE_TECHNIQUE))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    }   
}
