<?
include('../engine/session_check.php');
include('../config/common.php');
include('../engine/orders_db.php');
$h1 = 'Оформление заказа';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	
	if (isset($_COOKIE["id_author"])) :  // зарегистрирован ли пользователь
		$id_author = (int)$_COOKIE["id_author"];
		if ( isset($_COOKIE['id'])) {
			$i = 0;
			//смотрим что в корзине
			foreach ($_COOKIE['id'] as $key => $value ){
				//  $key - id_product
				//  $_COOKIE['id'][$key] -- количество
				if ((int)$key > 0) {
					if((int)isset($_COOKIE['id'][$key])) {
						$arr_cart[$i] = array('id' => (int)$key,
												'ammount' => (int)$_COOKIE['id'][$key]
												);
					$i++;
					}
				}
			}
			if (isset($arr_cart)) {
				// в корзине что-то есть
				$count_arr_cart = count($arr_cart);
				//сохраняем заказ в базе данных
				
				
				include('../templates/form_order_to_do.php');
			}
			else {
				//в корзине нет товаров
				$error = 'Ошибка. В корзине Нет товаров';
				include('../templates/error.php');
			}
		}
		else {
			$error = 'В корзине Нет товаров';
			include('../templates/error.php');
		}
	endif;   // для if (isset()) : зарегистрирован ли пользователь
?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>