<?
//проверка администратора
include('../../engine/session_check_admin.php');
//

include('../../config/common.php');

include('../../engine/admin/del_products_pick_to_del.php');
	
if (isset($_GET['comm']) && $_GET['comm'] == 1) {
	$h1    = 'Не выбрана ни одна запись!!<br>';
}
else $h1 = '';
$h1    .= 'Выбрать записи для удаления';
$title = $h1;	
include('../../templates/header.php');	

?>
<main>
<? include('../../templates/admin_products_pick_to_del.php'); ?>

</main>

<?
include('../../templates/footer.php');	
?>