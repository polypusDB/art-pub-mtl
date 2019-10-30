<?php
/**
 * Class CommentaireControlleur
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
class CommentaireControlleur extends Controlleur 
{
	/**
	 * GET : 
	 * 		/signaler           - signale un commentaire
	 * 		/suprimer           - supprime un commentaire
	 * 		@param requete	    - Recois un verbes et autre parametres qui sont utiliser pour la redirection
	 */
	public function getAction(Requete $requete)
	{        
        if($requete->url_elements[0] == "signaler"){
            if($requete->url_elements[1] && is_numeric($requete->url_elements[1])){
                $this->signalerCommentaire($requete->url_elements[1]);
            }
        }
        else if($requete->url_elements[0] == "suprimer"){
            if($requete->url_elements[1] && is_numeric($requete->url_elements[1])){
                $this->suprimerCommentaire($requete->url_elements[1]);
            }
            
        }

    }
    
    /**
	 * POST : 
	 * 		recois un json de commentaire 
	 * 		@param requete	    - Recois un verbes et autre parametres qui sont utiliser pour la redirection
	 */
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
    
    /**
     * Envoie le tableau au modele commentaire
     * @param aData - tableau du commentaire
     * retourne l'id du commentaire dans la base de données
     */
    protected function insertCommentaire($aData){
        $oCommentaire = new Commentaire();
        $res = $oCommentaire->insertCommentaire($aData);
        return $res;
    }

    /**
     * Envoie l'id du commentaire au modele commentaire
     * @param id - id du commentaire
     */
    protected function signalerCommentaire($id){
        $oCommentaire = new Commentaire();
        $aCommentaire = $oCommentaire->signalerCommentaire($id);
    }
    /**
     * Envoie l'id du commentaire au modele commentaire
     * @param id - id du commentaire
     */
    protected function suprimerCommentaire($id){
        $oCommentaire = new Commentaire();
        $aCommentaire = $oCommentaire->suprimer($id);
    }
	
}
?>