<?php

/**
 * Class Commentaire
 * 
 * @author Saul Turbide
 * @version 1.0
 * @update 2019-10-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 *  Cette classe sert à gérer les commentaires dans la base de données.
 * 
 */
class Commentaire extends Modele {
    /**
	 * Retourne la liste des commentaires par oeuvre
	 * @access public
     * @param id    - id de l'oeuvre
	 * @return Array
	 */	
    public function ListeCommentairesParOeuvreID($id){
        $oFiltrerChamp = new FiltrerChamp();
		$id = $oFiltrerChamp->FiltrerChamps($id);
        $res = Array();
        $query = "SELECT c.texte, u.nom_connexion, c.id_commentaire, c.signaler
        from commentaire c
        join oeuvre o
        on o.id_oeuvre = c.id_oeuvre
        join usager u
        on u.id_usager = c.id_usager
        where c.id_oeuvre = '$id'
        GROUP BY c.id_commentaire";
        if($mrResultat = $this->_db->query($query))
		{
			while($commentaire = $mrResultat->fetch_assoc())
			{
				$res[] = $commentaire;
			}
		}
		return $res;
    }

    /**
	 * Insère le commentaire dans la base de donnes et retourne l'id de ce commentaire
	 * @access public
     * @param aData    - tab du commentaire
	 * @return chaine de carac
	 */	
    public function insertCommentaire($aData){
        extract($aData);
        $oFiltrerChamp = new FiltrerChamp();
		$id_user = $oFiltrerChamp->FiltrerChamps($id_user);
		$id_oeuvre = $oFiltrerChamp->FiltrerChamps($id_oeuvre);
		$text = $oFiltrerChamp->FiltrerChamps($text);
        $query = "INSERT into commentaire (id_usager, id_oeuvre, texte)
        VALUES ('$id_user','$id_oeuvre', '$text')";
        $res = $this->_db->query($query);

        $idCom = $this->_db->insert_id;
        return $idCom;
    }

    /**
	 * Signale le commentaire en changant la valeur dans la BD
	 * @access public
     * @param aData    - tab du commentaire
	 * @return chaine de carac
	 */	
    public function signalerCommentaire($id){

        $oFiltrerChamp = new FiltrerChamp();
		$id = $oFiltrerChamp->FiltrerChamps($id);
        $query = "UPDATE commentaire
        SET signaler = true
        where id_commentaire = $id";
        
        
        $this->_db->query($query);
    }
    /**
	 * suprime le commentaire dans la base de donnes
	 * @access public
     * @param id    - string de l id du commentaire
	 */	
    public function suprimer($id){
        $oFiltrerChamp = new FiltrerChamp();
		$id = $oFiltrerChamp->FiltrerChamps($id);
        $query = "DELETE FROM commentaire
        WHERE id_commentaire = $id";

        $this->_db->query($query);
    }

    /**
	 * supprime le commentaire dans la BD
	 * @access public
     * @param string    chaine de carac avec Where
	 * @return chaine de carac
	 */	
    public function supCommentaire($string){
        $oFiltrerChamp = new FiltrerChamp();
		$string = $oFiltrerChamp->FiltrerChamps($string);
        $query = "DELETE 
        FROM commentaire
        $string";

        $this->_db->query($query);
    }
    /**
	 * get la liste des commentaire signaller
	 * @access public
	 */	
    public function GetListeSignaler(){
        $query = "SELECT c.id_commentaire, c. texte, u.id_usager, u.nom_connexion
        FROM commentaire c
        join usager u
        on u.id_usager = c.id_usager
        where signaler = 1";

        if($mrResultat = $this->_db->query($query)){
            while($commentaire = $mrResultat->fetch_assoc()){
                foreach($commentaire as $cle=> $valeur){
                    $commentaire[$cle] = utf8_encode($valeur);
                }
                $res[] = $commentaire;
            }
        }
        if(empty($res)){
            return "vide";
        }
        else{
            return($res);
        }
    }

    /**
	 * approuve le commentaire en changant la valeur dans la BD
	 * @access public
     * @param string    chaine de carac avec Where
	 * @return chaine de carac
	 */	
    public function appCommentaire($string){
        $oFiltrerChamp = new FiltrerChamp();
		$string = $oFiltrerChamp->FiltrerChamps($string);
        $query = "UPDATE commentaire 
        SET signaler = false
        $string";
        $this->_db->query($query);
    }
}




?>