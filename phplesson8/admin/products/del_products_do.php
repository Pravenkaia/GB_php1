<?
//проверка администратора
include('../../engine/session_check_admin.php');
//
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	header ("Location: /");
	exit;
elseif  (isset($_POST['NO']) && $_POST['NO'] !='')   :
	header ("Location: ../");
	exit;
else:
	
	include('../../config/common.php');
	include('../../engine/files.php');

	if (isset($_POST['id_del'])) :
	
		include('../../engine/admin/del_products_do.php');
	endif;
	
		$h1    .= 'Удаление записей';
		$title = $h1;
	
	
	include('../../templates/header.php');	

?>
		<main>

<?
			if (isset($oks)) {
				$ok = '';
				foreach($oks AS $key => $value) {
					$ok .= $value . '<br>';
				}
				if ($ok != '')
					include('../../templates/ok.php');
			}
			
			if (isset($err)) {
				$error = '';
				foreach($err AS $key => $value) {
					$error .= $value . '<br>';
				}
				if ($error != '')
					include('../../templates/error.php');
			}
			
			
?>
		
		</main>

<?

	include('../../templates/footer.php');	

endif;
?>