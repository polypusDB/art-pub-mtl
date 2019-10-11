<?php

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
class Usagers extends Modele {		

    public function getListe(){
        $query = "SELECT * FROM usager";
        if($resultat = $this->_db->query($query))
		{
			while($listeUsagers = $resultat->fetch_assoc())
			{
				$res[] = $listeUsagers;
			}
        }
		return $res;
    }

    public function deleteUsager($res){
		$query = "DELETE FROM usager $res";
		$res = $this->_db->query($query);
		echo $query;
    }

    public function postAction(){

    }

}




?>