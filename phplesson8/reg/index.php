<?
session_start();
$_SESSION["secret_number"] = mt_rand(1000,9999); //

$h1 = 'Регистрация';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>
	

<? 	

		include('../templates/reg_form.php');
?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>