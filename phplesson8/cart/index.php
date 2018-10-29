<?
include('../engine/cart_operations.php');
include('../config/common.php');


$h1 = 'Моя корзина';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	
		include('../engine/cart.php');
?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>