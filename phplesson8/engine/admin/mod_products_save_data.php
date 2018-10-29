<?
//проверка администратора
include('../../engine/session_check_admin.php');

if ($id_redact_bd >0) {
		$sql = "
			UPDATE $table_products 
			set 
				
				product_name='" 	. $product_name_bd . "',
				price='" 	        . $price_bd . "',
				photo_big='"		. $photo_big_bd . "',
				photo_thumb='"		. $photo_thumb_bd . "'
			WHERE
				id_product='" 		. $id_redact_bd . "'
			;";
			}
	else {
			$product_time_bd = time(); 
			$sql = "
			REPLACE INTO $table_products (

							product_name,
							product_text,
							price,
							photo_big,
							photo_thumb,
							product_time
						) VALUES ('" .
							$product_name_bd . "','" .
							$product_text_bd . "','" .
							$price_bd . "','" .
							$photo_big_bd . "','" .
							$photo_thumb_bd . "','" . 
							$product_time_bd
							. "');";
	}
		//echo $sql . "<br>"; 

		if($result = mysqli_query($connection,$sql)) {
			$ok = 'Запись о товаре введена успешно';
			include('../../templates/ok.php');	
		}
		else {
			$error = 'Невозможно выполнить запрос на сохранение товара';
			include('../../templates/error.php');
		}

		
		// если товар вводится впервые, нужно узнать его id почсле сохранения в БД
		if ($id_redact_bd == '') {
			$sql = "SELECT * FROM $table_products WHERE  product_time='" . $product_time_bd . "' AND product_name='" . $product_name_bd . "';";
			//echo $sql . '<br>';
			if ($result = mysqli_query($connection,$sql)) {
				while ($row = mysqli_fetch_array($result))  {
				$id_redact_bd  = $row['id_product'];
				}
				$ok = "Удачное получение id $id_redact_bd";
				include('../../templates/ok.php');
			}
			else {
				$error = 'Невозможно выполнить запрос на выборку ID только что введенного товара';
				include('../../templates/error.php');
			}  
			
		}
		//теперь можно сохранить группы товара в БД
		if ($id_redact_bd > 0) {
				//удаление устаревших связей с группами  из uid_groups
				$sql = "DELETE  FROM $table_uid_groups WHERE id_product=" . $id_redact_bd;
				//echo $sql . "<br>";

				if($result = mysqli_query($connection,$sql)) {
					$ok = 'Успешное обновление связей';
					include('../../templates/ok.php');
				}
				else {
					$error = 'Невозможно выполнить запрос на удаление устаревших связей из uid_groups';
					include('../../templates/error.php');
				}

				
				for ($j = 1; $j <= count($id_group_bd); $j++) {
						//Добавление актуальных связей  в uid_catalog
						$sql = "
							REPLACE INTO $table_uid_groups (
								id_product,
								id_group
							) VALUES ('" .
								$id_redact_bd  . "','" .
								$id_group_bd[$j] 
							. "');";
						//echo $sql . '<br>';  
						if ($result = mysqli_query($connection,$sql) ) {
							$ok = "Успешное обновление связей id товара $id_redact_bd и id группы $id_group_bd[$j] uid_groups";
							include('../../templates/ok.php');
						}
						else {
							$error = "Невозможно выполнить запрос на добавление связей id товара $id_redact_bd и id группы $id_group_bd[$j] в uid_groups";
							include('../../templates/error.php');
						}
				}
		}
?>