<?php
/**
 * Class Materiaux
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2016-11-25
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * 
 * 
 */
class Categorie extends Modele {		
	/**
	 * Retourne la liste des Materiaux
	 * @access public
	 * @return Array
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
	
}




?>