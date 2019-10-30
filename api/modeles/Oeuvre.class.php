<?php
/**
 * Class Oeuvre
 * 
 * @author Jonathan Martel modifié par Michel Plamondon et Saul Turbide
 * @version 1.0
 * @update 2014-09-11
 * @update 2019-10-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * Cette classe sert à gérer les oeuvres dans la base de données. 
 * 
 */
class Oeuvre extends Modele {	
	const TABLE_OEUVRE = "oeuvre";
	const TABLE_LIAISON_ARTISTE_OEUVRE = "artiste_oeuvre";
	// const TABLE_OEUVRE_DONNEES_EXTERNES = "apm__oeuvre_donnees_externes";
	
	/**
	 * Retourne la liste des oeuvres
	 * @access public
	 * @return Array
	 * @TODO Modifier le query afin de tenir compte des oeuvres à plusieurs artistes.
	 */
	public function getListe($filtre = "", $limit = 20) 
	{

		
		$res = Array();
		$query = "SELECT * , concat(artiste.nom,', ' ,artiste.prenom) nom_artiste
		FROM oeuvre
		JOIN artiste_oeuvre
		ON artiste_oeuvre.id_oeuvre = oeuvre.id_oeuvre
		JOIN artiste
		ON artiste_oeuvre.id_artiste = artiste.id_artiste
		JOIN endroit
		ON endroit.id_endroit = oeuvre.id_endroit
        JOIN arrondissement a
        ON a.id_arrondissement = endroit.id_arrondissement
		JOIN oeuvre_materiaux om
		on om.id_oeuvre = oeuvre.id_oeuvre $filtre 
		group by oeuvre.id_oeuvre
		ORDER BY oeuvre.titre
		limit $limit";

		if($mrResultat = $this->_db->query($query))
		{
			
			while($oeuvre = $mrResultat->fetch_assoc())
			{
				$oeu = end($res);
				if(isset($oeu) && $oeu['id_oeuvre'] != $oeuvre['id_oeuvre'])
				{
					
					$oeuvre['Artistes'] = Array();
					$oeuvre['Artistes'][] = Array	(	"id_artiste"=> $oeuvre['id_artiste'], 
														"Nom"=> $oeuvre['nom_artiste'],
														"NomCollectif"=> $oeuvre['nom_collectif']
													);
					unset($oeuvre['id_artiste']);
					unset($oeuvre['Nnom_artisteom']);
					unset($oeuvre['nom_collectif']);
					
					$res[] = $oeuvre;
				}
				else if(isset($oeu) && $oeu['id_oeuvre'] == $oeuvre['id_oeuvre'])
				{
					
					$i = count($res)-1;
					$res[$i]['Artistes'][] = Array	(	"id_artiste"=> $oeuvre['id_artiste'], 
														"Nom"=> $oeuvre['nom_artiste'],
														"NomCollectif"=> $oeuvre['nom_collectif']
													);
													
				}
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
	public function getOeuvre($id) 
	{
		$res = Array();
		$query = "SELECT o.titre,o.image, o.id_oeuvre, o.dimension, o.description, a.id_artiste, CONCAT(a.prenom, ', ', a.nom) as nomA, e.adresse, ar.nom as NomArrondissement, s.nom_francais as NomSupport, c.nom_francais as NomCategorie, e.coordonnee_latitude as latitude, e.coordonnee_longitude as longitude, e.parc, e.batiment, e.id_arrondissement, s.id_support, c.id_categorie,  e.coordonnee_latitude as coordonnee_latitude, e.coordonnee_longitude as coordonnee_longitude
		FROM oeuvre o 
		join artiste_oeuvre ao
		on ao.id_oeuvre = o.id_oeuvre
		join artiste a
        on a.id_artiste = ao.id_artiste
        JOIN endroit e
        ON e.id_endroit = o.id_endroit
        JOIN arrondissement ar
        ON ar.id_arrondissement = e.id_arrondissement
        join type_support s
        on s.id_support = o.id_support
        join categorie c 
        on c.id_categorie = o.id_categorie
		WHERE o.id_oeuvre = '$id'";
		

		if($mrResultat = $this->_db->query($query))
		{
			while($oeuvre = $mrResultat->fetch_assoc())
			{
				//extract($oeuvre);
				if(count($res) == 0)
				{
					$oeuvre['Artistes'] = Array();
					$oeuvre['Artistes'][] = Array	(	"id_artiste"=> $oeuvre['id_artiste'], 
														"nomA"=> $oeuvre['nomA']
													);
					unset($oeuvre['id_artiste']);
					unset($oeuvre['nomA']);
					$res = $oeuvre;
				}
				else
				{
					
					$res['Artistes'][] = Array	(	"id_artiste"=> $oeuvre['id_artiste'], 
													"nomA"=> $oeuvre['nomA']
													);
				}
			}
		}
		return $res;
	}
	
	
	/**
	 * Récupère les oeuvres avec l'id d'un artiste
	 * @access public
	 * @param int $id Identifiant de l'artiste
	 * @return Array
	 */
	public function getOeuvresParArtiste($id) 
	{
		$res = Array();
		$query = "	SELECT o.titre, o.id_oeuvre
		FROM oeuvre o
		JOIN artiste_oeuvre ao
		on ao.id_oeuvre = o.id_oeuvre
		WHERE ao.id_artiste = '$id'";
				
		if($mrResultat = $this->_db->query($query))
		{
			while($oeuvre = $mrResultat->fetch_assoc())
			{
				$res[] = $oeuvre;
				// var_dump($res);
			}
		}
		return $res;
	}
    
 	/**
	 * Supprime une oeuvre
	 * @access public
	 * @param int $id Identifiant de l'artiste à supprimer
	 */
	public function deleteOeuvre($res){
		$query = "DELETE FROM oeuvre $res";
		$res = $this->_db->query($query);
		
	}
    
 	/**
	 * Ajouter une oeuvre dans la base de données.
	 * @access public
	 * @param Array $aData Tableau contenant les données à ajouter dans la base de données.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si l'oeuvre a été ajoutée dans la base de données.
	 */     
	public function ajouterOeuvre($aData)
    {
        $resQuery = false;
		extract($aData);
        $query = "INSERT INTO ". self::TABLE_OEUVRE ."  (`titre`, `dimension`,`description`,`id_categorie`, `id_support`, `id_endroit`) VALUES ('".$titre."', '".$dimension."', '".$description."', '".$id_categorie."', '".$id_support."', '".$id_endroit."')";
		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
	}
    
  	/**
	 * Vérifie si une oeuvre existe dans la base de données.
	 * @access public
	 * @param String $titre Chaîne de caractère représentant le titre de l'oeuvre.
     * @return Array Tableau contenant les informations sur un oeuvre.
	 */ 
    public function verifierOeuvreExistant($titre)
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_OEUVRE." where titre = '".$titre."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    }

  	/**
	 * Récupére le dernier id d'une oeuvre.
	 * @access public
     * @return Array Tableau contenant le dernier id d'une oeuvre.
	 */ 
    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_oeuvre) as dernier from ". self::TABLE_OEUVRE))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    } 	
    
 	/**
	 * Modifier une oeuvre dans la base de données selon l'identifiant passé en paramètre.
	 * @access public
     * @param Array Tableau contenant les données à modifier.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si l'oeuvre a été modifiée dans la base de données.
	 */     
	public function modifierOeuvre($aData)
    {
        $resQuery = false;
		extract($aData);
        
		$query = "UPDATE ". self::TABLE_OEUVRE ."
		SET titre = '$titre',
		dimension = '$dimension',
		description = '$description',
		id_categorie = '$id_categorie',
        id_support = '$id_support',
        id_endroit = '$id_endroit'
		WHERE id_oeuvre = '$id_oeuvre'";

		$resQuery = $this->_db->query($query); 
        
		return $resQuery;
	}  
    
}




?>