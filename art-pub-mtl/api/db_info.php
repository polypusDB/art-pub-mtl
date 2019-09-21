 <?php
// Mettre les informations de connection mysql et renommer db_info.php.

define('HOST', 'localhost');

//var_dump($_SERVER);
if($_SERVER["HTTP_HOST"] == "127.0.0.1" || $_SERVER["HTTP_HOST"] == "localhost")
{
	define('USER', 'root');
	define('PASSWORD', '');	
	define('DATABASE', 'artpublicmtl');
}
else 	// Sur Webdev ou sur un hébergeur.
{
	define('USER', 'e1328301');
	define('PASSWORD', 'K2hpjjwXHoooLNDkTNv4');	
	define('DATABASE', 'e1328301');
}





?>