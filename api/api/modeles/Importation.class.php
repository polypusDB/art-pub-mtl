<?php
/**
 * Class Importation
 * 
 * @author Jonathan Martel modifié par Michel Plamondon
 * @version 1.0
 * @update 2019-10-10
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
        $oTraitementDonnees = new TraitementDonnees();
        $oArtisteOeuvre = new ArtisteOeuvre();
        $oOeuvreMateriaux = new OeuvreMateriaux();
        $oOeuvreTechnique = new OeuvreTechnique();
		
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
                    //$aArtiste['biographie_francais'] = "";
                    //$aArtiste['biographie_anglais'] = "";
                    $id_artiste = $oTraitementDonnees->traiterArtiste($aArtiste);
                }

                $id_arrondissement = $oTraitementDonnees->traiterArrondissement(trim($oeuvre->Arrondissement));
                
                $aEndroit['parc'] = $oeuvre->Parc;
                $aEndroit['batiment'] = $oeuvre->Batiment;
                $aEndroit['adresse'] = $oeuvre->AdresseCivique;
                $aEndroit['coordonnee_longitude'] = $oeuvre->CoordonneeLongitude;
                $aEndroit['coordonnee_latitude'] = $oeuvre->CoordonneeLatitude;
                $aEndroit['id_arrondissement'] = $id_arrondissement;
                $id_endroit = $oTraitementDonnees->traiterEndroit($aEndroit);
                
                $id_categorie = $oTraitementDonnees->traiterCategorie(trim(mb_strtolower($oeuvre->CategorieObjet), 'UTF-8'),trim(mb_strtolower($oeuvre->CategorieObjetAng), 'UTF-8'));
                
                 $id_support = $oTraitementDonnees->traiterTypeSupport(trim(mb_strtolower($oeuvre->SousCategorieObjet), 'UTF-8'),trim(mb_strtolower($oeuvre->SousCategorieObjetAng), 'UTF-8'));
                $id_oeuvre = 0;
                
                if(($id_categorie != 0) && ($id_support != 0) && ($id_endroit != 0))
                {
                    $aOeuvre['titre'] = $oeuvre->Titre;
                    $aOeuvre['dimension'] = $oeuvre->DimensionsGenerales;
                    $aOeuvre['description'] = "";
                    //$aOeuvre['description_francais'] = "";
                    //$aOeuvre['description_anglais'] = "";
                    //$aOeuvre['date_accession'] = $oeuvre->DateAccession;
                    $aOeuvre['id_categorie'] = $id_categorie;
                    $aOeuvre['id_support'] = $id_support;
                    $aOeuvre['id_endroit'] = $id_endroit;
                    $id_oeuvre = $oTraitementDonnees->traiterOeuvre($aOeuvre);
                }

                $tab_id_materiaux = $oTraitementDonnees->traiterMateriaux($oeuvre->Materiaux,$oeuvre->MateriauxAng);
                $tab_id_technique = $oTraitementDonnees->traiterTechnique($oeuvre->Technique,$oeuvre->TechniqueAng);
        
                if($id_oeuvre > 0)
                {
                    $oArtisteOeuvre->ajouterArtisteOeuvre($id_artiste,$id_oeuvre);
                    for($i = 0; $i < count($tab_id_materiaux); $i++)
                    {
                        $oOeuvreMateriaux->ajouterOeuvreMateriaux($id_oeuvre,$tab_id_materiaux[$i]);
                    }
                    for($i = 0; $i < count($tab_id_technique); $i++)
                    {
                        $oOeuvreTechnique->ajouterOeuvreTechnique($id_oeuvre,$tab_id_technique[$i]);
                    }                    
                }
		  }	
	   }
    }
}
?>