<?
session_start();
$mySess = session_id();
if (
	!isset($_COOKIE['ses'])  || $mySess == '' || $_COOKIE['ses'] != $mySess
	|| !isset($_COOKIE['id_author_rights'])  || $_COOKIE['id_author_rights']!= 1
	) {
	session_destroy();
	setcookie("id_author", 0, time()-160,'/');
	setcookie("id_author_rights", 0, time()-160,'/');
	
	header ("Location: /login");
	exit;
}

?>