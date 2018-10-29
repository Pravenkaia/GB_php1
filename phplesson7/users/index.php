<?
session_start();
$_SESSION ['permit_s'] = 'yes';
$mySess = session_id();
if (!isset($_COOKIE['ses'])  || $mySess == '' || $_COOKIE['ses'] != $mySess) {
	session_destroy();
	header ("Location: /login/");
	exit;
}

isset($_COOKIE["id_author"]) ? $id = $_COOKIE["id_author"] : 0;



$h1 = 'Личный кабинет';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	
	if ($id > 0) {
		include('../config/common.php');
		include('../engine/functions_db.php');
		$author = authors_get_id_arr($connection,$id);
		echo '<h3>Приветсвую тебя, ' . $author['author_name'] . '</h3>';
	}
	else {
		echo '<h3>Ошибка. Не приветсвую.</h3>';
	}
?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>