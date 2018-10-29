<?
//проверка администратора
include('../../engine/session_check_admin.php');
//
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	header ("Location: /");
	exit;
elseif (!isset($_POST['id_del'])) : 
		header ("Location: del_products_pick.php?comm=1");
		exit;
else:
	
	include('../../config/common.php');
	
	

	$h1    = 'Подтверждение удаления';
	$title = $h1;
	 // набор товаров для удаления
	include('../../engine/admin/del_products_picked_yes.php');

	include('../../templates/header.php');	

?>
		<main>

<?
			if (isset($countGoods) && $countGoods > 0) 
				include('../../templates/admin_products_del_yes.php');
?>		
		</main>

<?

	include('../../templates/footer.php');	

endif;
?>