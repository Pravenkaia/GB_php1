<?
//проверка администратора
include('../../engine/session_check_admin.php');


$what_product = ''; $k = 1;
		foreach ($_REQUEST['id_del'] as $id) {
			if ($id > 0) {
				$sql = "SELECT 
							photo_big,
							photo_thumb 
						FROM 
							$table_products 
						WHERE 
							id_product='%d';";
				$sql = sprintf($sql,(int)$id);
				//echo $sql . "<br>";
				if ($result = mysqli_query($connection,$sql)) { 
				
					while($row = mysqli_fetch_array($result))  {
						
						$photo_big        			= $row['photo_big'];
						$photo_thumb        		= $row['photo_thumb'];
						
						delfile($photo_big);
						delfile($photo_thumb);
						
						//удаление товара
						$sql = "delete FROM $table_products   WHERE id_product='%d'";
						$sql = sprintf($sql,(int)$id);
						//echo $sql . "<br>";
						
						if (!mysqli_query($connection,$sql))
							{ $err[] = "Невозможно выполнить запрос на удаление id=$id";}
							else {$oks[] = "Записи id=$id удалены успешно";}
						}
						$sql_uid = "delete FROM  $table_uid_groups WHERE id_product='%d'";
						$sql_uid = sprintf($sql_uid,(int)$id);
						//echo $sql_uid . "<br>";
						
						if ($result_uid = mysqli_query($connection,$sql_uid)) {
							$oks[] = "Успешное удаление связанных записей из таблицы $table_uid_groups";
						}
						else {
							$err[] = "Невозможно выполнить запрос на удаление связанных записей из таблицы $table_uid_groups";
						}
				}
				else 
					$err[] = "Невозможно выполнить запрос на выборку товаров id=$id";
						
			}
		}
?>		