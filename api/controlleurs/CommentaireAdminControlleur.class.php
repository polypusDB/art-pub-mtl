<?php
/**
 * Class AdminControlleur
 * Gère la page d'accueil
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 

class CommentaireAdminControlleur extends Controlleur 
{
	
	public function getAction(Requete $requete){
	
        if($_SESSION["utilisateur"]["type_acces"] == "admin"){
            // var_dump($requete->url_elements);
            if(isset($requete->url_elements[0]) && $requete->url_elements[0] == "sup"){
                // echo "on supprime";
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

	public function postAction(Requete $requete){

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
    
    protected function getCommnetaires(){
        $oCommentaire = new Commentaire();
        $aCommentaire = $oCommentaire->GetListeSignaler();
        $oVue = new AdminVue();
        $oVue->afficherCommentairesSignaler($aCommentaire);
    }

    protected function supCommentaire($string){
        $oCommentaire = new Commentaire();
        $oCommentaire->supCommentaire($string);
    }

    protected function appCommentaire($string){
        $oCommentaire = new Commentaire();
        $oCommentaire->appCommentaire($string);
    }

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