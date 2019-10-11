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
class Connection extends Modele {		
	/**
	 * Retourne les information de l'utilisateur connecté
	 * @access public
	 * @return Array
	 */
	
    public function getConnectionUser($user, $mdp){
        $query = "SELECT u.nom, u.prenom, u.courriel, u.nom_connexion,u.mot_passe, r.type_acces, u.id_usager
        from usager u
        join role r 
        on r.id_role = u.id_role
        where u.nom_connexion= '$user'";
        if($mrResultat = $this->_db->query($query)){
            $utilisateur = $mrResultat->fetch_assoc();
            if($utilisateur == ""){
                $res = false;
                return $res;
            }
            else{
                // var_dump($utilisateur);
                if(password_verify($mdp, $utilisateur["mot_passe"])){
                    return $utilisateur;
                }else{
                }
            }
           
        }else{
            echo "erreur sql";
        }

    }


    
    public function inscription($aData){
        extract($aData);
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $query = "INSERT into usager (nom_connexion, mot_passe, courriel, id_role)
        VALUES  ('$user', '$mdp', '$courriel', '3')";

        $res = $this->_db->query($query);
        return $res;
        
    }
    
}




?>