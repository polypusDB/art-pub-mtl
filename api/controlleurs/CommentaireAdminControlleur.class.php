<?php
/**
 * Class CommentaireAdminControlleur
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

class CommentaireAdminControlleur extends Controlleur 
{
    /**
	 * GET : 
	 * 		/comentaire/        - Liste des commentaires signalés
	 * 		/commentaire/sup/id - supprime un commentaire de la base de données
	 * 		/commentaire/app/id - approuve un commentaire et change sa value "signale" a false;
	 * 		@param requete	    - Recois un verbes et autre parametres qui sont utiliser pour la redirection
	 */
	public function getAction(Requete $requete){
	
        if($_SESSION["utilisateur"]["type_acces"] == "admin"){
            if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "sup"){
                $aData[] = $requete->url_elements[1];
				$string = $this->ArrayToString($aData);
				$this->supCommentaire($string);
                header("Location:/art-pub-mtl/api/commentaireAdmin");
            }
            else if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "app"){
                $aData[] = $requete->url_elements[1];
				$string = $this->ArrayToString($aData);
				$this->appCommentaire($string);
                header("Location:/art-pub-mtl/api/commentaireAdmin");
            }
            else{
                $this->getCommnetaires();
            }
        }
    }
    
    /**
	 * POST : 
	 * 		/isset($_POST["sup"]) - supprime plusieurs commentaires de la base de données
	 * 		/isset($_POST["app"]) - approuve plusieurs commentaires et change la value "signale" a false
	 * 		@param requete	    - Recois un verbes et autre parametres qui sont utiliser pour la redirection
	 */
	public function postAction(Requete $requete){
        /**
         * Recois le tableau de commentaire sélectionné et crée une string avec celui-ci
         */
        if(isset($_POST["sup"])){
            $msgErreur ="";
			if (isset($_POST['checks']) && is_array($_POST['checks'])) {
				$selected = array();
				$num_checks = count($_POST['checks']);
				foreach ($_POST['checks'] as $key => $value) {
						$selected[] = $value;
				}
			}
			if (empty($selected)){
				$msgErreur = 'Aucune commentaire sélectionné';
				$res = $this->getCommnetaires();
				$oVue = new AdminVue();
				$oVue->afficherCommentairesSignaler($res);
			}

			if($msgErreur == ""){
				$string = $this->ArrayToString($selected);
				$this->supCommentaire($string);
				header("Location:/art-pub-mtl/api/commentaireAdmin");
			}
        }
        else if(isset($_POST["app"])){
            $msgErreur ="";
			if (isset($_POST['checks']) && is_array($_POST['checks'])) {
				$selected = array();
				$num_checks = count($_POST['checks']);
				foreach ($_POST['checks'] as $key => $value) {
						$selected[] = $value;
				}
			}
			if (empty($selected)){
				$msgErreur = 'Aucune commentaire sélectionné';
				$res = $this->getCommnetaires();
				$oVue = new AdminVue();
				$oVue->afficherCommentairesSignaler($res);
			}

			if($msgErreur == ""){
				$string = $this->ArrayToString($selected);
				$this->appCommentaire($string);
				header("Location:/art-pub-mtl/api/commentaireAdmin");
			}
        }
    }
    
    /**
     * Recois la liste de commentaire a afficher
     * Appelle la vue et envoie le tableau de commentaires
     */
    protected function getCommnetaires(){
        $oCommentaire = new Commentaire();
        $aCommentaire = $oCommentaire->GetListeSignaler();
        $oVue = new AdminVue();
        $oVue->afficherCommentairesSignaler($aCommentaire);
    }

    /**
     * Envoie la string nécessaive a la suppression des commentaires
     * @param string - id en string sql
     */
    protected function supCommentaire($string){
        $oCommentaire = new Commentaire();
        $oCommentaire->supCommentaire($string);
    }
    /**
     * Envoie la string nécessaive a l'approbation des commentaires
     * @param string - id en string sql
     */
    protected function appCommentaire($string){
        $oCommentaire = new Commentaire();
        $oCommentaire->appCommentaire($string);
    }

    /**
     * Revois un tableau d'id et les convertis en string sql
     * @param aData - tableau d'id
     * retourne le tableau en partie de chaine sql
     */
    protected function ArrayToString($aData){
        $premier = true;

        foreach($aData as $id){
            if($premier == true){
                $res= "WHERE id_commentaire = ". $id;
            }
            else{
                $res .=" OR  id_commentaire = ". $id;
            }
            $premier = false;
        }
        return $res;
    }



}
?>