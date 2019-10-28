<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2016-03-03
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 /*
 * TODO : Commenter selon les standards du département.
 *
 */

 
 
class CommentaireControlleur extends Controlleur 
{
	

	public function getAction(Requete $requete)
	{
        // echo "Commentaire";
        
        if($requete->url_elements[0] == "signaler"){
            if($requete->url_elements[1] && is_numeric($requete->url_elements[1])){
                // echo json_encode($requete->url_elements[0]);
                $this->signalerCommentaire($requete->url_elements[1]);
            }
        }
        else if($requete->url_elements[0] == "suprimer"){
            echo "suprimer";
        }

	}

	public function postAction(Requete $requete){

        
        $res = $this->insertCommentaire($requete->parametres);

        $com = array(
            "texte" => $requete->parametres["text"],
            "id_user" => $requete->parametres["id_user"],
            "nom_connexion" => $_SESSION["utilisateur"]["nom_connexion"],
            "id_commentaire" =>$res
        );


        $com = json_encode($com);
        echo($com);

	}
    
    
    protected function insertCommentaire($aData){
        $oCommentaire = new Commentaire();
        $res = $oCommentaire->insertCommentaire($aData);
        return $res;
    }
    
    
    protected function signalerCommentaire($id){
        $oCommentaire = new Commentaire();
        $aCommentaire = $oCommentaire->signalerCommentaire($id);
    }
	
}
?>