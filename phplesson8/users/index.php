<?
//session_start();
//проверка существования и подлинности сессии
include('../engine/session_check.php');

isset($_COOKIE["id_author"]) ? $id = $_COOKIE["id_author"] : 0;



$h1 = 'Личный кабинет';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	
	if ($id > 0) :
		
		include('../config/common.php');
		include('../engine/functions_db.php');
		include('../engine/orders_db.php');
		include('../engine/order_states.php');
		
		$author = authors_get_id_arr($connection,$id);
		
		if ((int)$_GET['id_order'] > 0) {
			// товары в заказе по ID заказа
			//данные заказа
			$order = order_id_order($connection,(int)$_GET['id_order']);
			
			//данные товаров заказа
			$goods = products_in_order_id($connection,(int)$_GET['id_order']);
			
			if($goods) 
				$count_goods = count($goods);
			else
				$count_goods = 0;
			
			if ($count_goods > 0) {
				//состояние заказа
				$state = order_states($order['order_state']);
				
				include ('../templates/user_order.php');
			}
			else {
				$error = 'Заказ не найден';
				include ('../templates/error.php');
			}
		} 
		else {
			// возвращает заказы по id юзера
			$author_orders = author_orders_id_author($connection,$id);
			include ('../templates/user_cabinet.php');
		}

	else :
	
	
		$error = 'Ошибка авторизации.';
		include ('../templates/error.php');
		
		
	endif;
?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>