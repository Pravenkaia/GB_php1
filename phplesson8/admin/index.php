<?
//проверка админа
include('../engine/session_check_admin.php');

$h1 = 'Админка';
$title = $h1; 

include('../config/common.php');
include('../templates/header.php');

?>
<main>

<? include('../templates/admin_menu.php'); ?>

<main>
<?		
include('../templates/footer.php');		
?>			