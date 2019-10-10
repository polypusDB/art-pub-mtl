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

	//const URL_DATA = "http://donnees.ville.montreal.qc.ca/dataset/2980db3a-9eb4-4c0e-b7c6-a6584cb769c9/resource/18705524-c8a6-49a0-bca7-92f493e6d329/download/oeuvresdonneesouvertes.json";
	/**
	 * Fait la requête cUrl sur les données
	 * @access private
	 * @return Array
	 */
	private function requeteImportation() 
	{
		$res = Array();
		
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
		$aOeuvres = $this->requeteImportation();
        return $aOeuvres;
	}
    
	/**
	 * Mettre à jour les oeuvres à partir des données d'importation
	 * @access public
	 * @return Array Liste des oeuvres mise à jour
	 */
	public function mettreAJour($aOeuvres)
	{
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
                foreach($oeuvre->Artistes as $artiste)
                {
                    $aArtiste['nom'] = trim($artiste->Nom);;
                    $aArtiste['prenom'] = trim($artiste->Prenom);;
                    $aArtiste['nom_collectif'] = trim($artiste->NomCollectif);
                    $aArtiste['biographie'] = "";
                    $this->traiterArtiste($aArtiste);
                }
                $id_arrondissement = $this->traiterArrondissement(trim($oeuvre->Arrondissement));
                $aEndroit['parc'] = $oeuvre->Parc;
                $aEndroit['batiment'] = $oeuvre->Batiment;
                $aEndroit['adresse'] = $oeuvre->AdresseCivique;
                $aEndroit['coordonnee_longitude'] = $oeuvre->CoordonneeLongitude;
                $aEndroit['coordonnee_latitude'] = $oeuvre->CoordonneeLatitude;
                //$this->traiterEndroit($aEndroit,trim($oeuvre->Arrondissement));
                    
                
                /*if(trim(mb_strtolower($oeuvre->CategorieObjet) != "") || trim(mb_strtolower($oeuvre->CategorieObjetAng)))
                {
                    $aCategorie['nom_francais'] = trim(mb_strtolower($oeuvre->CategorieObjet), 'UTF-8');
                    $aCategorie['nom_anglais'] = trim(mb_strtolower($oeuvre->CategorieObjetAng), 'UTF-8');
                    $this->traiterCategorie($aCategorie);
                }*/
                
                /*if($oeuvre->SousCategorieObjet != "")
                {
                    array_push($tabTypeSupport, trim(mb_strtolower($oeuvre->SousCategorieObjet), 'UTF-8').";".trim(mb_strtolower($oeuvre->SousCategorieObjetAng), 'UTF-8'));
                }
                
                $materiauxFrancais = explode(';',trim($oeuvre->Materiaux));
                $materiauxAnglais = explode(';',trim($oeuvre->MateriauxAng));
                $indiceFrancais = 0;
                $indiceAnglais = 0;
                while(($indiceFrancais < count($materiauxFrancais)) && ($indiceAnglais < count($materiauxAnglais)))
                {
                    if($materiauxFrancais[$compteur] != "")
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
                    if($techniqueFrancais[$compteur] != "")
                    {
                        $technique = trim(mb_strtolower($techniqueFrancais[$indiceFrancais], 'UTF-8'))."*".trim(mb_strtolower($techniqueAnglais[$indiceAnglais], 'UTF-8'));
                        $technique = str_replace(".","",$technique);
                        $technique = str_replace("?","",$technique);
                        array_push($tabTechnique, trim(mb_strtolower($technique, 'UTF-8')));
                    }
                    $indiceFrancais++;
                    $indiceAnglais++;
                }
            }*/

            // Mise à jour des tables de base.
/*            $this->traiterCategorie($tabCategorie);
            $this->traiterTypeSupport($tabTypeSupport);
            $this->traiterMateriaux($tabMateriaux);
            $this->traiterTechnique($tabTechnique);
            $this->traiterArtiste($tabArtistes);
            $this->traiterOeuvre($aOeuvres);*/
            
		  }	
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
    
    private function traiterArrondissement($unArrondissement)
    {
        $oArrondissement = new Arrondissement();
        $id_arrondissement = 0;

        $donnees = $oArrondissement->verifierArrondissementExistant($unArrondissement);
        if(count($donnees) == 0)
        {
            if($oArrondissement->ajouterArrondissement($unArrondissement))
            {
                $id_arrondissement = $oArrondissement->getDernierEnregistrement();
            }
        }
        else
        {
            $id_arrondissement = $donnees['id_arrondissement'];
        }
        return $id_arrondissement;        
    }

    public function traiterEndroit($aData)
    {
        $oEndroit = new Endroit();
        $id_endroit = 0;

        $donnees = $oEndroit->verifierEndroitExistant($aData);
        if(count($donnees) == 0)
        {           
            if($oEndroit->ajouterEndroit($aData))
            {
                $id_endroit = $oEndroit->getDernierEnregistrement();
            }
        }
        else
        {
            $id_endroit = $donnees['id_endroit'];
        }
        return $id_endroit;
    }    
    
    private function traiterArtiste($aData)
    {
        $oArtiste = new Artiste();
        $id_artiste = 0;

        $donnees = $oArtiste->verifierArtisteExistant($aData);
        if(count($donnees) == 0)
        {
            if($oArtiste->AjouterArtiste($aData))
            {
                $id_endroit = $oEndroit->getDernierEnregistrement();
            }            
        }
        else
        {
            $id_artiste = $donnees['id_artiste'];
        }
        return $id_artiste;        
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

                $aData['titre'] = trim(mb_strtolower($oeuvre->Titre, 'UTF-8'));
                $aData['dimension'] = trim(mb_strtolower($oeuvre->DimensionsGenerales, 'UTF-8'));
                $aData['description_francais'] = "";
                $aData['description_anglais'] = "";
                $aData['date_oeuvre']= $oeuvre->DateAccession;
                $aData['id_categorie'] = $id_categorie;
                $aData['id_support'] = $id_support;
                $aData['id_endroit'] = $donnees['dernier'];
                
                $oOeuvre->ajouterOeuvre($aData);
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

}
?>