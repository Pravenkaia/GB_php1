<?
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	header ("Location: /");
	exit;
elseif  (isset($_POST['NO']) && $_POST['NO'] !='')   :
	header ("Location: ../menu.php");
	exit;
else:
	
	include('../../config/common.php');
	include('../../engine/files.php');

	if (isset($_POST['id_del'])) :
	
		$what_product = ''; $k = 1;
		foreach ($_REQUEST['id_del'] as $id) {
			if ($id > 0) {
				$sql = "SELECT 
							photo_big,
							photo_thumb 
						FROM 
							$table_products 
						WHERE 
							id_product='"    . $id . "';";
				//echo $sql . "<br>";
				$result = mysqli_query($connection,$sql) or die($err[] = "Невозможно выполнить запрос на выборку товаров id=$id");
				
					while($row = mysqli_fetch_array($result))  {
						
						$photo_big        			= $row['photo_big'];
						$photo_thumb        		= $row['photo_thumb'];
						
						delfile($photo_big);
						delfile($photo_thumb);
						
						
						$sql = "delete FROM $table_products   WHERE id_product='" . $id . "'";
						echo $sql . "<br>";
						if (!mysqli_query($connection,$sql))
							{ $msg = "Невозможно выполнить запрос на удаление id=$id";}
							else {$msg = "Записи id=$id удалены успешно";}
						}
						$sql_uid = "delete FROM  $table_uid_groups WHERE id_product=" . $id;
						echo $sql_uid . "<br>";
						$result_uid = mysqli_query($connection,$sql_uid) or die("Невозможно выполнить запрос на удаление связанных записей из таблицы $table_uid_groups");
						
			}
		}
	endif;
	
		$h1    .= 'Удаление записей';
		$title = $h1;
	
	
	include('../../templates/header.php');	

?>
		<main>
			
		</main>

<?

	include('../../templates/footer.php');	

endif;
?>