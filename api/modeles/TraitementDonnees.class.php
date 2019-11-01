<?php
/**
 * Class TraitementDonnees
 * 
 * @author Michel Plamondon
 * @version 1.0
 * @update 2019-10-08
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

class TraitementDonnees extends Modele {   
    
    public function traiterArrondissement($unArrondissement)
    {
        $oArrondissement = new Arrondissement();
        $id_arrondissement = 0;

        $donnees = $oArrondissement->verifierArrondissementExistant($unArrondissement);
        if(count($donnees) == 0)
        {
            if($oArrondissement->ajouterArrondissement($unArrondissement))
            {
                $donnees = $oArrondissement->getDernierEnregistrement();
                $id_arrondissement = $donnees['dernier'];
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
        if($donnees == 0)
        {           
            if($oEndroit->ajouterEndroit($aData))
            {
                $donnees = $oEndroit->getDernierEnregistrement();
                $id_endroit = $donnees['dernier'];
            }
        }
        else
        {
            $id_endroit = $donnees['id_endroit'];
        }
        return $id_endroit;
    }
    
    
    public function traiterTypeSupport($nom_francais,$nom_anglais)
    {
        $oTypeSupport = new TypeSupport();
        $id_support = 0;     
        $donnees = $oTypeSupport->verifierTypeSupportFrancaisExistant($nom_francais);
        if(count($donnees) == 0)
        {
            if($oTypeSupport->ajouterTypeSupport($nom_francais,$nom_anglais))
            {
                $donnees = $oTypeSupport->getDernierEnregistrement();
                $id_support = $donnees['dernier'];
            }
        } 
        else
        {
            $id_support = $donnees['id_support'];
        }
        return $id_support;        
    }  


    public function traiterCategorie($nom_francais,$nom_anglais)
    {        
        $oCategorie = new Categorie();
        $id_categorie = 0;
        $donnees = $oCategorie->verifierCategorieFrancaisExistant($nom_francais);
        if(count($donnees) == 0)
        {
            if($oCategorie->ajouterCategorie($nom_francais,$nom_anglais))
            {
                $donnees = $oCategorie->getDernierEnregistrement();
                $id_categorie = $donnees['dernier'];
            }
        }
        else
        {
            $id_categorie = $donnees['id_categorie'];
        }
        return $id_categorie;          
    } 

    public function traiterMateriaux($materiauxFrancais,$materiauxAnglais)
    {
        $oMateriaux = new Materiaux();
        $materiauxFrancais = str_replace(".","",$materiauxFrancais);
        $materiauxFrancais = str_replace("?","",$materiauxFrancais);
        $materiauxAnglais = str_replace(".","",$materiauxAnglais);
        $materiauxAnglais = str_replace("?","",$materiauxAnglais);
        $materiauxFrancais = trim(mb_strtolower($materiauxFrancais, 'UTF-8'));
        $materiauxAnglais = trim(mb_strtolower($materiauxAnglais, 'UTF-8'));
        $tab_id_materiaux = array();
        
        if(strpos($materiauxFrancais, ";") > 0)
        {
            $tabMateriauxFrancais = explode(';',trim($materiauxFrancais));
            $tabMateriauxAnglais = explode(';',trim($materiauxAnglais));
            $indiceFrancais = 0;
            $indiceAnglais = 0; 
            $id_materiaux = 0;

            if(count($tabMateriauxFrancais) == count($tabMateriauxAnglais))
            {
                while(($indiceFrancais < count($tabMateriauxFrancais)) && ($indiceAnglais < count($tabMateriauxAnglais)))
                {
                    if($tabMateriauxFrancais[$indiceFrancais] != "")
                    {
                        $donnees = $oMateriaux->verifierMateriauxFrancaisExistant($tabMateriauxFrancais[$indiceFrancais]);
                        if(count($donnees) == 0)
                        {
                            if($oMateriaux->ajouterMateriaux($tabMateriauxFrancais[$indiceFrancais],$tabMateriauxAnglais[$indiceAnglais]))
                            {
                                $donnees = $oMateriaux->getDernierEnregistrement();
                                $id_materiaux = $donnees['dernier'];
                            }            
                        }
                        else
                        {
                            $id_materiaux = $donnees['id_materiaux'];
                        }
                        array_push($tab_id_materiaux,$id_materiaux);
                    }
                    $indiceFrancais++;
                    $indiceAnglais++;
                }             
            }
            else if($materiauxFrancais != "")
            {
                $donnees = $oMateriaux->verifierMateriauxFrancaisExistant($materiauxFrancais);
                if(count($donnees) == 0)
                {
                    if($oMateriaux->ajouterMateriaux($materiauxFrancais,$materiauxAnglais))
                    {
                        $donnees = $oMateriaux->getDernierEnregistrement();
                        $id_materiaux = $donnees['dernier'];
                    }            
                }
                else
                {
                    $id_materiaux = $donnees['id_materiaux'];
                }               
                array_push($tab_id_materiaux,$id_materiaux);
            }            
        }
        return $tab_id_materiaux;
    } 
    
    public function traiterTechnique($techniqueFrancais,$techniqueAnglais)
    {
        $oTechnique = new Technique();
        $techniqueFrancais = str_replace(".","",$techniqueFrancais);
        $techniqueFrancais = str_replace("?","",$techniqueFrancais);
        $techniqueAnglais = str_replace(".","",$techniqueAnglais);
        $techniqueAnglais = str_replace("?","",$techniqueAnglais); $techniqueFrancais = trim(mb_strtolower($techniqueFrancais, 'UTF-8'));
        $techniqueAnglais = trim(mb_strtolower($techniqueAnglais, 'UTF-8'));
        $tab_id_technique = array();  
        
        if(strpos($techniqueFrancais, ";") > 0)
        {
            $tabTechniqueFrancais = explode(';',trim($techniqueFrancais));
            $tabTechniqueAnglais = explode(';',trim($techniqueAnglais));
            $indiceFrancais = 0;
            $indiceAnglais = 0; 
            $id_technique = 0;

            if(count($tabTechniqueFrancais) == count($tabTechniqueAnglais))
            {
                while(($indiceFrancais < count($tabTechniqueFrancais)) && ($indiceAnglais < count($tabTechniqueAnglais)))
                {
                    if($tabTechniqueFrancais[$indiceFrancais] != "")
                    {
                        $donnees = $oTechnique->verifierTechniqueFrancaisExistant($tabTechniqueFrancais[$indiceFrancais]);
                        if(count($donnees) == 0)
                        {
                            if($oTechnique->ajouterTechnique($tabTechniqueFrancais[$indiceFrancais],$tabTechniqueAnglais[$indiceAnglais]))
                            {
                                $donnees = $oTechnique->getDernierEnregistrement();
                                $id_technique = $donnees['dernier'];
                            }            
                        }
                        else
                        {
                            $id_technique = $donnees['id_technique'];
                        }
                        array_push($tab_id_technique,$id_technique);
                    }
                    $indiceFrancais++;
                    $indiceAnglais++;
                }             
            }
            else if($techniqueFrancais != "")
            {
                $donnees = $oTechnique->verifierTechniqueFrancaisExistant($techniqueFrancais);
                if(count($donnees) == 0)
                {
                    if($oTechnique->ajouterTechnique($techniqueFrancais,$techniqueAnglais))
                    {
                        $donnees = $oTechnique->getDernierEnregistrement();
                        $id_technique = $donnees['dernier'];
                    }            
                }
                else
                {
                    $id_technique = $donnees['id_technique'];
                }               
                array_push($tab_id_technique,$id_technique);
            }             
        }
        return $tab_id_technique;
    } 
    
    public function traiterArtiste($aData)
    {
        $oArtiste = new Artiste();
        $id_artiste = 0;

        $donnees = $oArtiste->verifierArtisteExistant($aData);
        if(count($donnees) == 0)
        {
            if($oArtiste->AjouterArtiste($aData))
            {
                $donnees = $oArtiste->getDernierEnregistrement();
                $id_artiste = $donnees['dernier'];
            }            
        }
        else
        {
            $id_artiste = $donnees['id_artiste'];
        }
        return $id_artiste;        
    }   
    
    public function traiterOeuvre($aData)
    {
        $oOeuvre = new Oeuvre();
        $id_oeuvre = 0;
        
        $donnees = $oOeuvre->verifierOeuvreExistant($aData['titre']);
        if($donnees == 0)
        {
            if($oOeuvre->AjouterOeuvre($aData))
            {
                $donnees = $oOeuvre->getDernierEnregistrement();
                $id_oeuvre = $donnees['dernier'];
            }            
        }
        else
        {
            $id_oeuvre = $donnees['id_oeuvre'];
        }
        return $id_oeuvre;    
    }

}
?>