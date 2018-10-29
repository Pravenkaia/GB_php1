<?
// выборка всех записей каталога товаров
function products_get($link){
	$sql = "SELECT * FROM " . TABLE_PRODUCTS . " ORDER BY product_name;";
	//echo $sql . "<br>";
	if ($result = mysqli_query($link,$sql)) {
		
		$n = mysqli_num_rows($result);

		for($i = 0; $i < $n; $i++){
			$row = mysqli_fetch_array($result);
			$res[] = $row;
		}
		
		if (isset($res))
			return $res;
		else 
			return false;
	}
	else {
		//die(mysqli_error($link));
		//$err[] = "Невозможно выполнить запрос на выборку товаров";
		return false;
	}
}

// выборка товара по id
function products_get_id($link, $id){
	$sql = sprintf("SELECT * FROM " . TABLE_PRODUCTS . " WHERE id_product='%d';",(int)$id);
	//echo $sql . "<br>";
	if ($result = mysqli_query($link,$sql)) {
		$row = mysqli_fetch_array($result);

		if (isset($row))
			return $row;
		else 
			return false;
	}
	else {
		
		//die(mysqli_error($link));
		//$err[] = "Невозможно выполнить запрос на выборку товаров";
		return false;
	}
}



?>