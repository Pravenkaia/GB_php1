<?
$server  = 'localhost';
$login   = 'root';
$pass    = '';
$db_name = 'php1';
$connection = mysqli_connect($server,$login,$pass,$db_name) or die("<h5>Невозможно подключиться к базе данных</h5>");
$db = mysqli_select_db($connection,$db_name) or die("<h5>Невозможно выбрать базу данных</h5>");
mysqli_set_charset($connection,'UTF8');

$foldBig = '/img/big/';        // путь к большим картинкам 
$foldThumbs = '/img/thumb/';   // путь к превьюшкам 

$pathAdmin = '/admin/';     //путь к админке 


//таблицы базы данных
$table_photos 			   = "photos";
$table_products     	   = "products";
$table_products_groups     = "products_groups";
$table_products_photos     = "products_photos";
$table_uid_groups     	   = "uid_groups";





$src_plus           = "/img/shablon-images/b_plus.png";
$size_plus          =  getimagesize($_SERVER['DOCUMENT_ROOT'] . $src_plus);

$src_edit           = "/img/shablon-images/b_edit.png";
$size_edit          =  getimagesize($_SERVER['DOCUMENT_ROOT'] . $src_edit);

$src_drop           = "/img/shablon-images/b_drop.png";
$size_drop          =  getimagesize($_SERVER['DOCUMENT_ROOT'] . $src_drop);

	
?>	