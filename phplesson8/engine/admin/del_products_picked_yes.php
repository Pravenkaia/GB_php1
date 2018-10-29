<?
	
		$what_product = ''; $k = 1;
		foreach ($_REQUEST['id_del'] as $id) {
			if ($id > 0) {
				// Формирование условия запроса
				if     ($what_product === '') {$what_product .= " id_product='"    . $id . "'";}
				else                          {$what_product .= " OR id_product='" . $id . "'";}
			}
		}
		if ($what_product != '') {
			$what_product = ' WHERE (' . $what_product . ') ';
		}
		else {
			$h1 .= 'Не выбрана ни одна запись!<br>';
		}

		$sql = "SELECT * FROM $table_products $what_product ORDER BY product_name;";
	//echo $sql . "<br>";
	$result = mysqli_query($connection,$sql) or die($err[] = "Невозможно выполнить запрос на выборку товаров");
	$divs_product = '';
	for ($i = 0; $row = mysqli_fetch_array($result);  $i++)  {
		$id_product_list[$i]     	   		= $row['id_product'];
		$product_name_list[$i]         		= $row['product_name'];
		$product_text_list[$i]        		= $row['product_text'];
		$photo_big_list[$i]        			= $row['photo_big'];
		$photo_thumb_list[$i]        		= $row['photo_thumb'];
		
		if ($photo_thumb_list[$i] == '') {
			$photo_thumb_list[$i] = NO_PHOTO;
		}
		
	}
	
	$countGoods = $i;

?>