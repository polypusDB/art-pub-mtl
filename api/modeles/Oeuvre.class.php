<?php
/**
 * Class Oeuvre
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2014-09-11
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * 
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
	public function getListe() 
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
        JOIN arrondissement
        ON arrondissement.id_arrondissement = endroit.id_arrondissement"; 

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
		$query = "SELECT o.titre, o.dimension, o.description, a.id_artiste, CONCAT(a.prenom, ', ', a.nom) as nomA, e.adresse, ar.nom as NomArrondissement, s.nom_francais as NomSupport, c.nom_francais as NomCategorie
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
		$query = "	SELECT * FROM ". self::TABLE_OEUVRE ." Oeu 
					inner join ". self::TABLE_LIAISON_ARTISTE_OEUVRE ." O_A ON Oeu.id = O_A.id_oeuvre
					where id_artiste=". $id;
				
		if($mrResultat = $this->_db->query($query))
		{
			while($oeuvre = $mrResultat->fetch_assoc())
			{
				$res[] = $oeuvre;
			}
		}
		return $res;
	}
	
	
	
	/**
	 * Modifie les informations sur une oeuvre
	 * @access public
	 * @param int $id Identifiant de l'oeuvre
	 * @return Array
	 */


	// public function modifOeuvre($id, $aData) 
	// {
	// 	$resQuery = false;
	// 	$res = Array();
	// 	if($this->verifDonneesExterne($id))
	// 	{
	// 		if(isset($aData['Description']) && isset($aData['Categorie']))
	// 		{
	// 			foreach ($aData as $cle => $valeur) {
	// 				$aSet[] = ($cle . "= '".$valeur. "'");
	// 			}
	// 			if(count($aSet) > 0)
	// 			{
	// 				$query = "Update ". self::TABLE_OEUVRE_DONNEES_EXTERNES ." SET ";
	// 				$query .= join(", ", $aSet);
					
	// 				$query .= (" WHERE id_oeuvre = ". $id); 
	// 				$resQuery = $this->_db->query($query);
	// 				echo $query;
	// 			}
	// 		}
	// 	}
	// 	else 
	// 	{
	// 		if(extract($aData) > 0)
	// 		{
	// 			$query = "INSERT INTO ". self::TABLE_OEUVRE_DONNEES_EXTERNES ."  (`id_oeuvre`, `Description`, `Categorie`, `cote`) 
	// 			VALUES ('".$id. "','". $Description. "','". $Categorie. "','1')";
	// 			$resQuery = $this->_db->query($query);
	// 			echo $query;
	// 		}
	// 	}
	
	// 	return ($resQuery ? $id : 0);
	// }
	
	// private function verifDonneesExterne($id)
	// {
	// 	$res = Array();
	// 	$query = "select * from ". self::TABLE_OEUVRE_DONNEES_EXTERNES ." where id_oeuvre=". $id;
	// 	if($mrResultat = $this->_db->query($query))
	// 	{
	// 		$res = $mrResultat->fetch_assoc();
	// 	}
	// 	return (count($res) >0 ? true : false);
	// }

	public function deleteOeuvre($id){
		
		$query = "DELETE 
		FROM oeuvre 
		WHERE id_oeuvre = $id";

		// a tester -----------------------------------------
		$res = $this->_db->query($query);
		
	}
	
}




?>