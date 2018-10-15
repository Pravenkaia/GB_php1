<?
include('../engine/cart.php');

$h1 = 'Моя корзина';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	

		if(isset($goods)) {
			/*foreach($goods as $key => $value) {
			echo $key . '=' . $value . '<br>';
		}*/
		echo $cartForm;
		}
		else 
			echo '<h3>Ваша корзина пуста!</h3>';

?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>