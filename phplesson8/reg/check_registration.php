<?
include('../engine/reg/add_author_check_registration.php');

$h1 = 'Регистрация. Проверка ';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	

		if($errors != '') {
			
			echo $errors;
			echo $errForm;
			
		}
		else {
			if($insert) 
				echo '<h3>Успешное сохранение данных пользователя</h3>';
			else 
				echo '<h3>Ошибка сохранения!</h3>';
		}
?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>