<?
include('../config/common.php');
include('orders_db.php');


if (isset($_POST['id_product']) && isset($_POST['id_order']) ) {

		// обновление данных о товаре в заказе по id заказа
		del_product_in_order($connection,$_POST['id_order'],$_POST['id_product']);

}





?>