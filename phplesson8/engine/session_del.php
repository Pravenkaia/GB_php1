<?
session_start();
session_destroy();
setcookie("id_author", 0, time()-160,'/');
header ("Location: /login/");
exit;
?>