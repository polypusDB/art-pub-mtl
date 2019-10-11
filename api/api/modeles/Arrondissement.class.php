<?php
/**
 * Class Arrondissement
 * 
 * @author Jonathan Martel modifié par Michel Plamondon
 * @version 2.0
 * @update 2019-10-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * Cette classe sert à gérer les arrondissements dans la base de données.
 * 
 */
class Arrondissement extends Modele {	
	const TABLE_ARRONDISSEMENT = "arrondissement";
		
	/**
	 * Retourne la liste des arrondissements
	 * @access public
	 * @return Array Liste des arrondissements contenus dans la base de données.
	 */
	public function getListe() 
	{
		$res = Array();
		$query = "select id_arrondissement, nom as nom_arrondissement from arrondissement";
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
	 * Ajouter un arrondissement dans la base de données.
	 * @access public
	 * @param Array $aData Tableau contenant les données à ajouter dans la base de données.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si l'arrondissement a été ajouté dans la base de données.
	 */ 
    public function ajouterArrondissement($nom)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_ARRONDISSEMENT ."  (`nom`) VALUES ('".$nom. "')";
        $resQuery = $this->_db->query($query); 
		return $resQuery;
    }

  	/**
	 * Vérifie si un arrondissement existe dans la base de données.
	 * @access public
	 * @param String $nom Chaîne de caractères représentant le nom à vérifier dans la base de données.
     * @return Array Tableau contenant les informations sur un arrondissement.
	 */
    public function verifierArrondissementExistant($nom)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ARRONDISSEMENT." where nom = '".$nom."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }	
    
  	/**
	 * Récupére le dernier id d'un arrondissement.
	 * @access public
     * @return Array Tableau contenant le dernier id d'un arrondissement.
	 */
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