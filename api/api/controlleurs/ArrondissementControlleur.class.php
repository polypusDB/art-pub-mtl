<?php
/**
 * Controlleur de la ressource Arrondissement
 * 
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2016-11-25
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 /*
 * 
 *
 */

 
 
class ArrondissementControlleur extends Controlleur 
{
	
	// GET : 
	// 		/arrondissement/ - Liste des oeuvres
	
	
	public function getAction(Requete $requete)
	{
		$res = array();
		
        $res = $this->getListeArrondissement();
		if(isset($_GET['json']))
		{
			echo json_encode($res);	
		}
	}
	
	
		
	protected function getListeArrondissement()
	{
		
		$oArrond= new Arrondissement();
		$aArrond = $oArrond->getListe();
		
		return $aArrond;
	}
	
	
	
}
?>