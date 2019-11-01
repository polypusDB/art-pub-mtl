<?php
/**
 * Class Oeuvre
 * 
 * @author Jonathan Martel modifié par Saul Turbide et Michel Plamondon
 * @version 1.0
 * @update 2019-10-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * Cette classe sert à gérer les artistes dans la base de données. 
 * 
 */
class Artiste extends Modele {	
	const TABLE_ARTISTE = "artiste";
	const TABLE_LIAISON_ARTISTE_OEUVRE = "oeuvre_artiste";
		
	/**
	 * Retourne la liste des artistes
	 * @access public
	 * @return Array Liste des artistes contenus dans la base de données.
	 */
	public function getListe($filtre = "", $limit = 20) 
	{
		$oFiltrerChamp = new FiltrerChamp();
		$limit = $oFiltrerChamp->FiltrerChamps($limit);
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
	 * Récupère les informations sur un artiste
	 * @access public
	 * @param int $id Identifiant de l'artiste
	 * @return Array Tableau contenant les informations sur un artiste.
	 */
	public function getArtiste($id) 
	{
		
		$oFiltrerChamp = new FiltrerChamp();
		$id = $oFiltrerChamp->FiltrerChamps($id);
		$res = Array();
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ARTISTE." where id_artiste=". $id))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
	}

 	/**
	 * Supprime un artiste
	 * @access public
	 * @param int $id Identifiant de l'artiste à supprimer
	 */
	public function deleteArtiste($res){
		$oFiltrerChamp = new FiltrerChamp();
		$res = $oFiltrerChamp->FiltrerChamps($res);
		$query = "DELETE FROM artiste $res";
		$res = $this->_db->query($query);
	}

 	/**
	 * Ajouter un artiste dans la base de données.
	 * @access public
	 * @param Array $aData Tableau contenant les données à ajouter dans la base de données.
	 * @return Boolean Retourne une valeur booléenne pour déterminer si l'artiste a été ajouté dans la base de données.
	 */  
	public function AjouterArtiste($aData){
		extract($aData);
		$oFiltrerChamp = new FiltrerChamp();
		$nom = $oFiltrerChamp->FiltrerChamps($nom);
		$prenom = $oFiltrerChamp->FiltrerChamps($prenom);
		$nom_collectif = $oFiltrerChamp->FiltrerChamps($nom_collectif);
		$biographie = $oFiltrerChamp->FiltrerChamps($biographie);
		$query = "INSERT INTO artiste (nom, prenom, nom_collectif, biographie)
		VALUES ('$nom','$prenom', '$nom_collectif','$biographie')";
		$this->_db->query($query);
	}

 	/**
	 * Modifier un artiste dans la base de données.
	 * @access public
	 * @param Array $aData Tableau contenant les données à modifier dans la base de données.
	 */ 
	public function modifierArtiste($aData){
		extract($aData);
		$oFiltrerChamp = new FiltrerChamp();
		$nom = $oFiltrerChamp->FiltrerChamps($nom);
		$prenom = $oFiltrerChamp->FiltrerChamps($prenom);
		$nom_collectif = $oFiltrerChamp->FiltrerChamps($nom_collectif);
		$biographie = $oFiltrerChamp->FiltrerChamps($biographie);
		$id = $oFiltrerChamp->FiltrerChamps($id);
		$query = "UPDATE artiste
		SET nom = '$nom',
		prenom = '$prenom',
		nom_collectif = '$nom_collectif',
		biographie = '$biographie'
		WHERE id_artiste = '$id'";

		$this->_db->query($query);
	}

  	/**
	 * Vérifie si un artiste existe dans la base de données.
	 * @access public
	 * @param Array $aData Tableau contenant les données à vérifier dans la base de données.
     * @return Array Tableau contenant les informations sur un artiste.
	 */    
    public function verifierArtisteExistant($aData)
    {
		$res = Array();
		extract($aData);
		$oFiltrerChamp = new FiltrerChamp();
		$nom = $oFiltrerChamp->FiltrerChamps($nom);
		$prenom = $oFiltrerChamp->FiltrerChamps($prenom);
		$nom_collectif = $oFiltrerChamp->FiltrerChamps($nom_collectif);
		if($mrResultat = $this->_db->query("select * from ". self::TABLE_ARTISTE." where nom = '".$nom."' and prenom = '".$prenom."' and nom_collectif = '".$nom_collectif."'"))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;
    }

  	/**
	 * Récupére le dernier id d'un artiste.
	 * @access public
     * @return Array Tableau contenant le dernier id d'un artiste.
	 */  
    public function getDernierEnregistrement()
    {
		$res = Array();
		if($mrResultat = $this->_db->query("select max(id_artiste) as dernier from ". self::TABLE_ARTISTE))
		{
			$res = $mrResultat->fetch_assoc();
		}
		return $res;        
    }	
}




?>