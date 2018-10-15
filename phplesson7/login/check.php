<?
include('../engine/reg/check_authorisation.php');

$h1 = 'Авторизация. Проверка ';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	

		if($errors != '') {
			
			echo $errors;
			include('../templates/log_form.php');
			
		}

?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>