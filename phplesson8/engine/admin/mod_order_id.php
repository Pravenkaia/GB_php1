<?
//проверка админа
include('../../engine/session_check_admin.php');
if ((int)$_POST['id_order'] > 0) :
				
				$user     = user_of_order($connection,(int)$_POST['id_order']);
				$order    = order_id_order($connection,(int)$_POST['id_order']);
				$products = products_in_order_id($connection,(int)$_POST['id_order']);
				
				$count_products = count($products);
				
				//состояние заказа
				$state = order_states($order['order_state']);
				

				include ('../../templates/admin_user_order_redact.php');
		
			else:
			
				$error = 'Ошибка вывода заказа';
				include('../../templates/error.php');
				
			endif;
			
?>