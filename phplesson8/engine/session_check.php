<?
session_start();
$mySess = session_id();
if (!isset($_COOKIE['ses'])  || $mySess == '' || $_COOKIE['ses'] != $mySess) {
	session_destroy();
	header ("Location: /login/");
	exit;
}

?>