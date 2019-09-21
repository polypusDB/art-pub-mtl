<?php
/**
 * Class Importation
 * 
 * @author Jonathan Martel modifié par Michel Plamondon
 * @version 1.0
 * @update 2019-09-19
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * @TODO Créer les fonctions d'importation et de mise à jour des oeuvres
 */
 
 
class Importation extends Modele {	
	//const TABLE_IMPORTATION = "apm__importation";
	
	//const TABLE_OEUVRE = "apm__oeuvre";
	const URL_DATA = "http://donnees.ville.montreal.qc.ca/dataset/2980db3a-9eb4-4c0e-b7c6-a6584cb769c9/resource/18705524-c8a6-49a0-bca7-92f493e6d329/download/oeuvresdonneesouvertes.json";
	/**
	 * Fait la requête cUrl sur les données
	 * @access private
	 * @return Array
	 */
	private function requeteImportation() 
	{
		$res = Array();
		
		/*$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, self::URL_DATA);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		if(!($reponse = curl_exec($ch)))
		{
			 trigger_error(curl_error($ch)); 
		}
		
		//var_dump(curl_getinfo($ch));
		curl_close($ch);
		//$reponse = utf8_encode($reponse);
		return json_decode($reponse);*/
        //$url = constants::URL_DATA;
        $json = file_get_contents("http://donnees.ville.montreal.qc.ca/dataset/2980db3a-9eb4-4c0e-b7c6-a6584cb769c9/resource/18705524-c8a6-49a0-bca7-92f493e6d329/download/oeuvresdonneesouvertes.json");
		return json_decode($json);
	}
	
	/**
	 * Procéde à la mise à jour des oeuvres
	 * @access public
	 * @return boolean
	 */
	public function importerOeuvre() 
	{
		$aOeuvres = Array();
		$i =0;
		$aOeuvres = $this->requeteImportation();
        $tabCategorie = Array();
        $tabTypeSupport = Array();
        $tabMateriaux= Array();
        $tabTechnique = Array();
        $tabArrondissement = Array();
        $tabArtistes = Array();
        $tabEndroit = Array();
		
		if($aOeuvres)
		{
            
			foreach ($aOeuvres as $cle => $oeuvre)
            {   
                array_push($tabCategorie, trim(mb_strtolower($oeuvre->CategorieObjet), 'UTF-8').";".trim(mb_strtolower($oeuvre->CategorieObjetAng), 'UTF-8'));
                if($oeuvre->SousCategorieObjet != "")
                {
                    array_push($tabTypeSupport, trim(mb_strtolower($oeuvre->SousCategorieObjet), 'UTF-8').";".trim(mb_strtolower($oeuvre->SousCategorieObjetAng), 'UTF-8'));
                }
                
                $materiauxFrancais = explode(';',trim($oeuvre->Materiaux));
                $materiauxAnglais = explode(';',trim($oeuvre->MateriauxAng));
                $indiceFrancais = 0;
                $indiceAnglais = 0;
                while(($indiceFrancais < count($materiauxFrancais)) && ($indiceAnglais < count($materiauxAnglais)))
                {
                    if($materiauxFrancais[$i] != "")
                    {
                        $materiaux = trim(mb_strtolower($materiauxFrancais[$indiceFrancais], 'UTF-8'))."*".trim(mb_strtolower($materiauxAnglais[$indiceAnglais], 'UTF-8'));
                        $materiaux = str_replace(".","",$materiaux);
                        $materiaux = str_replace("?","",$materiaux);
                        array_push($tabMateriaux, trim(mb_strtolower($materiaux, 'UTF-8')));
                    }
                    $indiceFrancais++;
                    $indiceAnglais++;
                }
                
                $techniqueFrancais = explode(';',trim($oeuvre->Technique));
                $techniqueAnglais = explode(';',trim($oeuvre->TechniqueAng));
                $indiceFrancais = 0;
                $indiceAnglais = 0;
                while(($indiceFrancais < count($techniqueFrancais)) && ($indiceAnglais < count($techniqueAnglais)))
                {
                    if($techniqueFrancais[$i] != "")
                    {
                        $technique = trim(mb_strtolower($techniqueFrancais[$indiceFrancais], 'UTF-8'))."*".trim(mb_strtolower($techniqueAnglais[$indiceAnglais], 'UTF-8'));
                        $technique = str_replace(".","",$technique);
                        $technique = str_replace("?","",$technique);
                        array_push($tabTechnique, trim(mb_strtolower($technique, 'UTF-8')));
                    }
                    $indiceFrancais++;
                    $indiceAnglais++;
                }              
                array_push($tabArrondissement, trim($oeuvre->Arrondissement));
                foreach($oeuvre->Artistes as $artiste)
                {
                    $unArtiste = $artiste->Nom."*".$artiste->Prenom."*".$artiste->NomCollectif;
                    array_push($tabArtistes,$unArtiste);
                }
            }
            // Détruire les doublons
            $tabCategorie = array_unique($tabCategorie);
            $tabTypeSupport = array_unique($tabTypeSupport);
            $tabMateriaux = array_unique($tabMateriaux);
            $tabTechnique = array_unique($tabTechnique);
            $tabArrondissement = array_unique($tabArrondissement);
            $tabArtistes = array_unique($tabArtistes);
            $tabEndroit = array_unique($tabEndroit);

            // Mise à jour des tables de base.
            $this->traiterCategorie($tabCategorie);
            $this->traiterTypeSupport($tabTypeSupport);
            $this->traiterMateriaux($tabMateriaux);
            $this->traiterTechnique($tabTechnique);
            $this->traiterArrondissement($tabArrondissement);
            $this->traiterArtiste($tabArtistes);
            $this->traiterOeuvre($aOeuvres);
		}
	}
    
    private function traiterCategorie($tabCategorie)
    {        
        $oCategorie = new Categorie();
        
        foreach($tabCategorie as $categorie)
        {
            $categorie = explode(';',$categorie);
            $donnees = $oCategorie->verifierCategorieFrancaisExistant($categorie[0]);
            if(count($donnees) == 0)
            {
                $oCategorie->ajouterCategorie($categorie[0],$categorie[1]);
            }          
        }
    }
    
    private function traiterTypeSupport($tabTypeSupport)
    {
        $oTypeSupport = new TypeSupport();
        
        foreach($tabTypeSupport as $typeSupport)
        {
            $typeSupport = explode(';',$typeSupport);
            $donnees = $oTypeSupport->verifierTypeSupportFrancaisExistant($typeSupport[0]);
            if(count($donnees) == 0)
            {
                $oTypeSupport->ajouterTypeSupport($typeSupport[0],$typeSupport[1]);
            }          
        }       
    }    
    
    private function traiterMateriaux($tabMateriaux)
    {
        $oMateriaux = new Materiaux();
        
        foreach($tabMateriaux as $materiaux)
        {
            $materiaux = explode('*',$materiaux);

            $donnees = $oMateriaux->verifierMateriauxFrancaisExistant($materiaux[0]);
            if(count($donnees) == 0)
            {
                $oMateriaux->ajouterMateriaux($materiaux[0],$materiaux[1]);
            }
        }
    } 
    
    private function traiterTechnique($tabTechnique)
    {
        $oTechnique = new Technique();
        
        foreach($tabTechnique as $technique)
        {
            $technique = explode('*',$technique);

            $donnees = $oTechnique->verifierTechniqueFrancaisExistant($technique[0]);
            if(count($donnees) == 0)
            {
                $oTechnique->ajouterTechnique($technique[0],$technique[1]);
            }
        } 
    }    
    
    private function traiterArrondissement($tabArrondissement)
    {
        $oArrondissement = new Arrondissement();
        foreach($tabArrondissement as $arrondissement)
        {
            $donnees = $oArrondissement->verifierArrondissementExistant($arrondissement);
            if(count($donnees) == 0)
            {
                $oArrondissement->ajouterArrondissement($arrondissement);
            }          
        }
    }
    
    private function traiterArtiste($tabArtistes)
    {
        $oArtiste = new Artiste();
        foreach($tabArtistes as $artiste)
        {
            $artiste = explode('*',$artiste);

            $donnees = $oArtiste->verifierArtisteExistant($artiste[0],$artiste[1],$artiste[2]);
            if(count($donnees) == 0)
            {
                $aData['nom'] = $artiste[0];
                $aData['prenom'] = $artiste[1];
                $aData['nom_collectif'] = $artiste[2];
                $aData['biographie'] = "";
                
                $oArtiste->AjouterArtiste($aData);
            }
        }
    }   
    
    private function traiterEndroit($tabEndroit)
    {
        $oEndroit = new Endroit();
        
               
        foreach($tabEndroit as $endroit)
        { 
            $endroit = explode('*',$endroit);
            
            $donnees = $oEndroit->verifierEndroitExistant($endroit[3],$endroit[4]);
            if(count($donnees) == 0)
            {
                $donnees = $oArrondissement->verifierArrondissementExistant($endroit[5]);
                if($donnees == 0)
                {
                    $oArrondissement->ajouterArrondissement($arrondissement);
                }
                else
                {
                    $id_arrondissement = $donnees['id_arrondissement'];
                }
                $oEndroit->ajouterEndroit($endroit[0],$endroit[1],$endroit[2],$endroit[3],$endroit[4],$id_arrondissement);
            }
        }       
    }
    
    private function traiterOeuvre($oeuvres)
    {
        $oArrondissement = new Arrondissement();
        $oArtiste = new Artiste();
        $oArtisteOeuvre = new ArtisteOeuvre();
        $oCategorie = new Categorie();
        $oEndroit = new Endroit();
        $oMateriaux = new Materiaux();
        $oOeuvre = new Oeuvre();
        $oOeuvreMateriaux = new OeuvreMateriaux();
        $oOeuvreTechnique = new OeuvreTechnique();
        $oTechnique = new Technique();
        $oTypeSupport = new TypeSupport();
        
        foreach($oeuvres as $oeuvre)
        {
            $donnees = $oOeuvre->verifierOeuvreExistant(trim(mb_strtolower($oeuvre->Titre, 'UTF-8')));
            if(count($donnees) == 0)
            {
                $donnees = $oCategorie->verifierCategorieFrancaisExistant(trim(mb_strtolower($oeuvre->CategorieObjet, 'UTF-8')));
                $id_categorie = $donnees['id_categorie'];
                
                $donnees = $oTypeSupport->verifierTypeSupportFrancaisExistant(trim(mb_strtolower($oeuvre->SousCategorieObjet, 'UTF-8')));
                $id_support = $donnees['id_support'];
                
                $donnees = $oArrondissement->verifierArrondissementExistant(trim(mb_strtolower($oeuvre->Arrondissement, 'UTF-8')));
                $id_arrondissement = $donnees['id_arrondissement'];
                
                $oEndroit->ajouterEndroit($oeuvre->Parc,$oeuvre->Batiment,$oeuvre->AdresseCivique,$oeuvre->CoordonneeLatitude,$oeuvre->CoordonneeLongitude,$id_arrondissement);
                $donnees = $oEndroit->getDernierEnregistrement();
                $id_endroit = $donnees['dernier'];
                
                $oOeuvre->ajouterOeuvre(trim(mb_strtolower($oeuvre->Titre, 'UTF-8')),trim(mb_strtolower($oeuvre->DimensionsGenerales, 'UTF-8')),"",$id_categorie,$id_support,$id_endroit);
                $donnees = $oOeuvre->getDernierEnregistrement();
                if($donnees != 0)
                {
                    $id_oeuvre = $donnees['dernier'];
                    foreach($oeuvre->Artistes as $artiste)
                    { 
                        $donnees = $oArtiste->verifierArtisteExistant($artiste->Nom, $artiste->Prenom, $artiste->NomCollectif);
                        $id_artiste = $donnees['id_artiste'];
                        $oArtisteOeuvre->ajouterArtisteOeuvre($id_artiste,$id_oeuvre);
                    }
                    $materiauxFrancais = explode(';',trim($oeuvre->Materiaux));
                    foreach($materiauxFrancais as $materiau)
                    {
                        $donnees = $oMateriaux->verifierMateriauxFrancaisExistant(trim($materiau));
                        $id_materiaux = $donnees['id_materiaux'];
                        $oOeuvreMateriaux->ajouterOeuvreMateriaux($id_oeuvre,$id_materiaux);
                    }
                    $techniqueFrancais = explode(';',trim($oeuvre->Technique));
                    foreach($techniqueFrancais as $technique)
                    {
                        $donnees = $oTechnique->verifierTechniqueFrancaisExistant(trim($technique));
                        $id_technique = $donnees['id_technique'];
                        $oOeuvreTechnique->ajouterOeuvreTechnique($id_oeuvre,$id_technique);
                    }                    
                }
            } 
        }
    }
    
	/**
	 * Mettre à jour les oeuvres à partir des données d'importation
	 * @access public
	 * @return Array Liste des oeuvres mise à jour
	 */
	public function mettreAJour()
	{
		$res = Array();
	}

}
?>