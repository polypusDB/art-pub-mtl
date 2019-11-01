<?php
/**
 * Class OeuvreTechnique
 * 
 * @author Michel Plamondon
 * @version 2.0
 * @update 2019-09-17
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 *  Cette classe sert à faire le lien entre un matériau et une oeuvre.
 * 
 */
class OeuvreTechnique extends Modele {	
	const TABLE_OEUVRE_TECHNIQUE = "oeuvre_technique";
    
 	/**
	 * Ajouter un lien entre un matériau et une oeuvre dans la base de données.
	 * @access public
	 * @param int $id_materiaux Identifiant du matériau contenant les données à ajouter dans la base de données.
     *        int $id_oeuvre Identifiant de l'oeuvre contenant les données à ajouter dans la base de données.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si lien entre un matériau et une oeuvre a été ajouté dans la base de données.
	 */  
    public function ajouterOeuvreTechnique($id_oeuvre,$id_technique)
    {
		$resQuery = false;
		$res = Array();
        $query = "INSERT INTO ". self::TABLE_OEUVRE_TECHNIQUE ."  (`id_oeuvre`, `id_technique`) VALUES ('".$id_oeuvre. "', '".$id_technique. "')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
    }
    
 	/**
	 * Récupère les liens entre des techniques et une oeuvre dans la base de données.
	 * @access public
	 * @param int $id_oeuvre Identifiant de l'oeuvre contenant les données à récupérer dans la base de données.
	 * @return Array Retourne la liste des liens pour l'oeuvre demandée.
	 */    
    public function getOeuvreTechniqueByIdOeuvre($id_oeuvre)
    {
		$res = Array();
		$query = "select nom_francais, nom_anglais
                    from technique
                    join oeuvre_technique
                    on technique.id_technique = oeuvre_technique.id_technique
                    where id_oeuvre = '$id_oeuvre'";
		if($mrResultat = $this->_db->query($query))
		{
			while($materiau = $mrResultat->fetch_assoc())
			{
				$res[] = $materiau;
			}
		}
		return $res;       
    }
    
    
    public function modifierOeuvreTechnique($id_oeuvre, $id_technique)
    {
        $resQuery = false;
        
		$query = "UPDATE ". self::TABLE_OEUVRE_TECHNIQUE ."
        id_technique = '$id_technique'
		WHERE id_oeuvre = '$id_oeuvre'";

		$resQuery = $this->_db->query($query); 
        
		return $resQuery;        
    }

	public function supprimerOeuvreTechnique($id_oeuvre){
		$query = "DELETE ". self::TABLE_OEUVRE_TECHNIQUE ."
		$id_oeuvre";

		echo $query;
		// $resQuery = $this->_db->query($query); 
	}
}