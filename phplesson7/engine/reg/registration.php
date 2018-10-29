<?
session_start();
$_SESSION["secret_number"] = mt_rand(1000,9999); //генерация секретной кода для картинки капчи
 
?>