<?php
/**
 * Class ArrondissementControlleur
 * 
 * @author Saul Turbide, Marie-C Renou, Angela sanchez, Michel Plamondon
 * @version 1.0
 * @update 2019-06-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */
 
 

 
 
class ArrondissementControlleur extends Controlleur 
{
	/**
	 * GET : 
	 * 		arrondissement/ - Liste des oeuvres À CHANGER
	 */
	
	
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