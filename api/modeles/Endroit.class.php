<?php
/**
 * Class Endroit
 * 
 * @author Michel Plamondon
 * @version 1.0
 * @update 2014-09-11
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * Cette classe sert à gérer les endroits dans la base de données. 
 * 
 */
class Endroit extends Modele {	
	const TABLE_ENDROIT = "endroit";
		
	/**
	 * Retourne la liste des endroits
	 * @access public
	 * @return Array Liste des endroits contenus dans la base de données.
	 */
	public function getListe() 
	{
		$res = Array();
		$query = "select * from ". self::TABLE_ENDROIT;
		if($mrResultat = $this->_db->query($query))
		{
			while($endroit = $mrResultat->fetch_assoc())
			{
				foreach($endroit as $cle=> $valeur)
				{
					$endroit[$cle] = utf8_encode($valeur);
				}
				$res[] = $endroit;
			}
		}
		return $res;
	}
	
	/**
	 * Récupère les informations sur un endroit
	 * @access public
	 * @param int $id Identifiant de l'endroit
	 * @return Array Tableau contenant les informations sur un endroit.
	 */
	public function getEndroit($id) 
	{
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ENDROIT." where id_endroit=". $id))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
	}
    
  	/**
	 * Récupére le dernier id d'un endroit.
	 * @access public
     * @return Array Tableau le dernier id d'un endroit.
	 */ 
    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_endroit) as dernier from ". self::TABLE_ENDROIT))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    }

  	/**
	 * Vérifie si un endroit existe dans la base de données.
	 * @access public
	 * @param Array $aData Tableau contenant les données à vérifier dans la base de données.
     * @return Array Tableau contenant les informations sur un endroit.
	 */ 
    public function verifierEndroitExistant($aData)
    {
		$res = Array();
        extract($aData);
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ENDROIT." where parc = '".$parc."' and batiment = '".$batiment."' and adresse = '".$adresse."'and coordonnee_latitude = '".$coordonnee_latitude."' and coordonnee_longitude = '".$coordonnee_longitude."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }

 	/**
	 * Ajouter un endroit dans la base de données.
	 * @access public
	 * @param Array $aData Tableau contenant les données à ajouter dans la base de données.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si l'endroit a été ajouté dans la base de données.
	 */  
    public function ajouterEndroit($aData)
    {
		$resQuery = false;
        extract($aData);
        $query = "INSERT INTO ". self::TABLE_ENDROIT ."  (`parc`, `batiment`, `adresse`, `coordonnee_latitude`, `coordonnee_longitude`, `id_arrondissement`) VALUES ('".$parc."', '".$batiment."', '".$adresse."', '".$coordonnee_latitude."', '".$coordonnee_longitude."', $id_arrondissement)";
        $resQuery = $this->_db->query($query); 
		return $resQuery;    
    }   
}




?>