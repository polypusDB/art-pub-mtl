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
class Artiste extends Modele {	
	const TABLE_ARTISTE = "artiste";
	const TABLE_LIAISON_ARTISTE_OEUVRE = "oeuvre_artiste";
		
	/**
	 * Retourne la liste des oeuvres
	 * @access public
	 * @return Array
	 */
	public function getListe($filtre = "", $limit = 20) 
	{
		$res = Array();
		$query = "select * from ". self::TABLE_ARTISTE . " $filtre 
		group by artiste.id_artiste
		order by artiste.nom
		limit $limit";
		if($mrResultat = $this->_db->query($query))
		{
			while($artiste = $mrResultat->fetch_assoc())
			{
				foreach($artiste as $cle=> $valeur)
				{
					$artiste[$cle] = utf8_encode($valeur);
				}
				$res[] = $artiste;
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
	public function getArtiste($id) 
	{
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ARTISTE." where id_artiste=". $id))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
	}

	public function deleteArtiste($res){
		$query = "DELETE FROM artiste $res";
		$res = $this->_db->query($query);
		echo $query;
	}


	public function AjouterArtiste($aData){
		extract($aData);
		$query = "INSERT INTO artiste (nom, prenom, nom_collectif, biographie)
		VALUES ('$nom','$prenom', '$nom_collectif','$biographie')";
		$this->_db->query($query);
	}

	public function modifierArtiste($aData){
		extract($aData);
		$query = "UPDATE artiste
		SET nom = '$nom',
		prenom = '$prenom',
		nom_collectif = '$nom_collectif',
		biographie = '$biographie'
		WHERE id_artiste = '$id'";

		$this->_db->query($query);
	}

    public function verifierArtisteExistant($aData)
    {
		$res = Array();
        extract($aData);
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ARTISTE." where nom = '".$nom."' and prenom = '".$prenom."' and nom_collectif = '".$nom_collectif."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }	
}




?>