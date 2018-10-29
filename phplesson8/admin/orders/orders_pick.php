<?
//проверка администратора
include('../../engine/session_check_admin.php');
//
include('../../config/common.php');




$h1 = 'Выбрать заказ для редактирования';
$title = $h1; 

include('../../templates/header.php');

include('../../config/common.php');
include('../../engine/functions_db.php');
include('../../engine/orders_db.php');
		
?>
	
	<main>


<? 	

		
		
		$orders = orders_all($connection);

		include ('../../templates/admin_orders_pick_to_redact.php');



?> 
	

	</main>  
	
<?
include('../../templates/footer.php');
?>