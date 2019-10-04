<?php

if(isset($_POST)){
    // $com = $_POST["text"];

    var_dump($_POST);
}
/**
 * Class Commentaire
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
class Commentaire extends Modele {		

    public function ListeCommentairesParOeuvreID($id){
        $query = "SELECT c.texte, u.nom_connexion, c.id_commentaire
        from commentaire c
        join oeuvre o
        on o.id_oeuvre = c.id_oeuvre
        join usager u
        on u.id_usager - c.id_usager
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

    public function postAction(){
        if(isset($_POST)){
            var_dump($_POST);
        } 
    }
}




?>