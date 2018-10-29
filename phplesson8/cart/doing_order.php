<?
session_start();
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
// несанкционированный вход. Разрешен только из формы, заполненной на сервере
	session_destroy();
	header ("Location: /");
	exit;
elseif (!isset($_COOKIE["id_author"])):
//пользователь не авторизован
	session_destroy();
	header ("Location: ../login/");
	exit;
elseif (isset($_POST['to_del_order'])):
//пользователь отменил заказ => обратно в корзину
	header ("Location: /cart/");
	exit;
else:
	$error = '';
	if (!isset($_POST['phone_number']) || !is_int(+str_replace('(','',str_replace(')','',str_replace(' ','',$_POST['phone_number'])))) ) 
		$error = 'Неверно заполнено поле  "Телефон"';
	if (empty($_POST['to_order'])) 
		$error .= '<br>Ошибка передачи данных. Заказ не может быть сохранен';
endif;

include('../config/common.php');
include('../engine/session_check.php');
include('../engine/cart_operations.php');
include('../engine/orders_db.php');

$error_order = '';  //ошибки сохранения товара
if ($error == '') { //нет ошибок ввода
			// пользователь оформляет заказ
			//Функция создания заказа. Получаем свежесозданный id
			$id_order = add_order(
								$connection, 
								(int)$_COOKIE["id_author"], 
								time(), 
								str_replace('(','',str_replace(')','',str_replace(' ','',$_POST['phone_number']))),
								htmlspecialchars(strip_tags(trim($_POST['comm'])))
							);
			if ($id_order > 0) {
				// добавляем товары в заказ
				$ok = add_products_to_order(
					$connection, 
					(int)$_COOKIE["id_author"], 
					$id_order,
					$_POST['id_product'], 
					$_POST['ammount']);
					
				//удаляем товары из корзины
				if ($ok && isset($_COOKIE['id']))
					delСookie($_COOKIE['id']);
			}
			else {
				$error_order = 'Ошибка cохранения заказа. Заказ не может быть сохранен';
			}
}
$h1 = 'Сохранение и редактирование заказа';
$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	

	if($error != '') : //ошибки ввода
		include('../templates/error.php');
		include('../templates/error_back_to_do_order.php');
	elseif ($error_order != '') :

			$error = $error_order;
			include('../templates/error.php');

	else: 
		$ok = 'Успешное сохранение заказа';	
		include('../templates/ok.php');
		
	endif; // для  //ошибки ввода

?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>