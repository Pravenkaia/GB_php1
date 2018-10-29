<?
$sql = "SELECT * FROM $table_products ORDER BY product_name;";
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