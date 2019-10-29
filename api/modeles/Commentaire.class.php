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

    public function ListeCommentairesParOeuvreID($id){
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


    public function insertCommentaire($aData){
        extract($aData);
        $query = "INSERT into commentaire (id_usager, id_oeuvre, texte)
        VALUES ('$id_user','$id_oeuvre', '$text')";
        $res = $this->_db->query($query);

        $idCom = $this->_db->insert_id;
        return $idCom;
    }


    public function signalerCommentaire($id){
        $query = "UPDATE commentaire
        SET signaler = true
        where id_commentaire = $id";
        
        
        $this->_db->query($query);
    }

    public function suprimer($id){
        // echo $id;

        $query = "DELETE FROM commentaire
        WHERE id_commentaire = $id";

        $this->_db->query($query);
    }

    public function supCommentaire($string){
        $query = "DELETE 
        FROM commentaire
        $string";

        $this->_db->query($query);
    }

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


    public function appCommentaire($string){
        $query = "UPDATE commentaire 
        SET signaler = false
        $string";

        // echo $query;
        $this->_db->query($query);
    }
}




?>