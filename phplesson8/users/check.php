<?
//session_start();
//проверка существования и подлинности сессии
include('../engine/session_check.php');

// переход на страницу не из формы 
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	header ("Location: /");
	exit;
elseif (
		!isset($_POST['id_order']) 
		|| empty($_POST['id_order']) 
		|| (!isset($_POST['toPay']) && !isset($_POST['toCancel'])) 
		):
	// возвращение в личный кабинет
	header ("Location: /users/");
	exit;
endif;

// получаем id юзера
isset($_COOKIE["id_author"]) ? $id = $_COOKIE["id_author"] : 0;

$url_include = '';  //
if (isset($_POST['toPay'])) {
	$h1 = ' Оплата заказа.';
	$url_include =  '../engine/to_pay';
}
elseif (isset($_POST['toCancel'])) {
	$h1 = ' Отмена заказа.';

}

$title = $h1; 

include('../templates/header.php');

?>
	
	<main>


<? 	
	if ($id > 0) :
		
		include('../config/common.php');
		include('../engine/functions_db.php');
		include('../engine/orders_db.php');
		
			if ($_POST['id_order'] > 0 && isset($_POST['toCancel'])) {
			//удалене заказа по ID заказа
				$ok = del_order($connection,$_POST['id_order']);
				if($ok) {
					$ok = 'Заказ успешно отменен';
					include ('../templates/ok.php');
				}
				else {
					$error = 'Неудачная отмена заказа';
					include ('../templates/error.php');
				}
			};

			if ($_POST['id_order'] > 0 && isset($_POST['toPay'])) {
			//меняем статус заказа на "оплачен" по ID заказа
				$ok = update_order_paid($connection,$_POST['id_order']);
				if($ok) {
					$ok = 'Заказ успешно оплачен';
					include ('../templates/ok.php');
				}
				else {
					$error = 'Неудачная оплата заказа';
					include ('../templates/error.php');
				}
			};

	else :
	
	
		$error = 'Ошибка авторизации.';
		include ('../templates/error.php');
		
		
	endif;
?> 
	

	</main>  
	
<?
include('../templates/footer.php');
?>