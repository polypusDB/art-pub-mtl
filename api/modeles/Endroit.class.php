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
 * 
 * 
 */
class Endroit extends Modele {	
	const TABLE_ENDROIT = "endroit";
		
	/**
	 * Retourne la liste des oeuvres
	 * @access public
	 * @return Array
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
	 * Récupère une oeuvre avec son id
	 * @access public
	 * @param int $id Identifiant de l'oeuvre
	 * @return Array
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
    
    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_endroit) as dernier from ". self::TABLE_ENDROIT))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    }
	
    public function verifierEndroitExistant($aData)
    {
		$res = Array();
        extract($aData);
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ENDROIT." where coordonnee_latitude = '".$coordonnee_latitude."' and coordonnee_longitude = '".$coordonnee_longitude."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }
    
    public function ajouterEndroit($aData)
    {
		$res = Array();
        extract($aData);
        $query = "INSERT INTO ". self::TABLE_ENDROIT ."  (`parc`, `batiment`, `adresse`, `coordonnee_latitude`, `coordonnee_longitude`, `id_arrondissement`) VALUES ('".$parc."', '".$batiment."', '".$adresse."', '".$coordonnee_latitude."', '".$coordonnee_longitude."', $id_arrondissement)";
        $resultat = $this->_db->query($query); 
		return $resultat;    
    }    
}




?>