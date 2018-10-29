<?
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	header ("Location: /");
	exit;

else:
//проверка админа
include('../../engine/session_check_admin.php');
endif;// if: 1 SERVER['REQUEST_METHOD'] != 'POST'


include('../../config/common.php');
include('../../engine/functions_db.php');
include('../../engine/orders_db.php');
include('../../engine/order_states.php');


$h1 = 'Выбрать заказ для редактирования';
$title = $h1; 

include('../../templates/header.php');



		
?>
	
	<main>


<? 	
			// изменение статуса заказа, если нужно
			include('../../engine/admin/order_change_state.php');
			// вывод заказа
			include('../../engine/admin/mod_order_id.php');


?> 
	

	</main>  
	
<?
include('../../templates/footer.php');
?>
