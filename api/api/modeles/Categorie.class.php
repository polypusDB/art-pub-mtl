<?php
/**
 * Class Categorie
 * 
 * @author Michel Plamondon et Saul Turbide
 * @version 1.0
 * @update 2019-09-17
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * Cette classe sert à gérer les catégories dans la base de données.
 * 
 */
class Categorie extends Modele {	
	const TABLE_CATEGORIE = "categorie";
		
	/**
	 * Retourne la liste des catégories
	 * @access public
	 * @return Array Liste des catégories contenus dans la base de données.
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
    
 	/**
	 * Ajouter une catégorie dans la base de données.
	 * @access public
	 * @param String $nom_francais Chaîne de caractères représentant le nom de la catégorie en français.
              String $nom_anglais Chaîne de caractères représentant le nom de la catégorie en anglais.   
	 * @return Boolean Retourne une valeur booléenne pour déterminer si la catégorie a été ajoutée dans la base de données.
	 */ 
    public function ajouterCategorie($nom_francais,$nom_anglais)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_CATEGORIE ."  (`nom_francais`, `nom_anglais`) VALUES ('".$nom_francais. "', '".$nom_anglais. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }

  	/**
	 * Vérifie si une catégorie existe dans la base de données.
	 * @access public
	 * @param String $nom Chaîne de caractères représentant le nom à vérifier dans la base de données.
     * @return Array Tableau contenant les informations sur une catégorie.
	 */ 
    public function verifierCategorieFrancaisExistant($nom_francais)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_CATEGORIE." where nom_francais = '".$nom_francais."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }

  	/**
	 * Récupére le dernier id d'une catégorie.
	 * @access public
     * @return Array Tableau contenant le dernier id d'une catégorie.
	 */  
    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_categorie) as dernier from ". self::TABLE_CATEGORIE))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    }
	
}




?>