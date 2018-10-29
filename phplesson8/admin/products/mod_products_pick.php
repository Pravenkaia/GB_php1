<?
//проверка администратора
include('../../engine/session_check_admin.php');

include('../../config/common.php');

include('../../engine/admin/mod_products_pick_to_redact.php');

$h1    = 'Выбрать запись для редактирования';
$title = $h1;	
include('../../templates/header.php');	

?>
<main>

	<? 
		//форма выбора тоара для редактирования
		include('../../templates/admin_products_pick.php');	 
	?>

</main>

<?
include('../../templates/footer.php');	
?>