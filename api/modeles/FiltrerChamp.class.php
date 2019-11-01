<?php
/**
 * Class filtrerChamp
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2014-09-11
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 * 
 * 
 */
class filtrerChamp extends Modele {		


public function FiltrerChamps($var){
    $res = $this->_db->real_escape_string($var);
    $res = htmlspecialchars($res);

    return $res;
  }


    

    
}




?>