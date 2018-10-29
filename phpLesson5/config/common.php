<?

$foldBig = '/img/big/';        // путь к большим картинкам альбома
$foldThumbs = '/img/thumb/';   // путь к превьюшкам альбома

$pathAdminAlbum = '/admin/album/';     //путь к админке альбома
$pathAlbum      = '/album/';           //путь к альбому  с большими фотами


$table_photos 		= "photos";
$table_photos_like  = "photos_like";


$server  = 'localhost';
$login   = 'root';
$pass    = '';
$db_name = 'php1';

$connection = mysqli_connect($server,$login,$pass,$db_name) or die("<h5>Невозможно подключиться к базе данных</h5>");
$db = mysqli_select_db($connection,$db_name) or die("<h5>Невозможно выбрать базу данных</h5>");
mysqli_set_charset($connection,'UTF8');
	
?>	