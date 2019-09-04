<?php
/**
 * Class Importation
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-08-12
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * @TODO Créer les fonctions d'importation et de mise à jour des oeuvres
 */
 
 
class Importation extends Modele {	
	const TABLE_IMPORTATION = "apm__importation";
	
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
		
		$ch = curl_init();
	
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
		return json_decode($reponse);
		
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
		
		if($aOeuvres)
		{
			foreach ($aOeuvres as $cle => $oeuvre) {
				echo "<p>".$oeuvre->Titre . "</p>";
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