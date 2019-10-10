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
    
    public function traiterCategorie($tabCategorie)
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
    
    public function traiterMateriaux($tabMateriaux)
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
    
    public function traiterTechnique($tabTechnique)
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
        if(count($donnees) == 0)
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
        if(count($donnees) == 0)
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