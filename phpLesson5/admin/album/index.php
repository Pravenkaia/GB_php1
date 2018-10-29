<?
$title = 'Админка. Фотоальбом';
$h1 = $title;

include('../../config/common.php');
include('../../templates/header.php');

?>

<main>

<?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		include('../../engine/loads/files.php');
}
	else {
		if (isset($err) && $err != '') {  //переход из проверки кода без отправик формы
			echo '<h5>' . $err . '</h5>';
		}
		include('../../templates/photo/photo_form.php');
	}

?>

<?
include('../../templates/footer.php');
?>
