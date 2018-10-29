<?

if ( isset($_COOKIE['id'])) {

	$sum = 0;
	$i = 0;
	foreach ($_COOKIE['id'] as $key => $value ){
		
		$goods[$i] = goods_get($connection,$key);
		if (is_array($goods[$i])) {
			$goods[$i]['id'] = $key;
			$goods[$i]['ammount'] = $value;
			$sum += $goods[$i]['price'] * $goods[$i]['ammount'];
		}
		$i++;
	}
	
	if (isset($goods)) {
		$count_goods = count($goods);
		//форма корзины товаров
		include('../templates/form_cart.php');

		isset($_COOKIE["id_author"]) ? $id_author = $_COOKIE["id_author"] : 0;
			
		if ($id_author > 0) { 
		//echo '$id_author=' . $id_author . '<br>';
			// ссылка оформить заказ
			$link_url = 'do_order.php?do_order=1';
			$link_text = 'Оформить заказ';
		}
		else {
			// ссылка войти и оформить заказ
			$link_url  = '/login/';
			$link_text = 'Войти и оформить заказ';
		}
		include('../templates/form_order_to_go.php');

	}
}
else  {
			$error = 'Ваша корзина пуста!';
			include('../templates/error.php');
}

			

?>