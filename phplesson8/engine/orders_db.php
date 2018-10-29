<?
// создаёт новый заказ и возвращает его id
function add_order($link, $id_user, $order_date, $phone_number,$comm){
	$err = '';
	$sql = "INSERT INTO " . TABLE_ORDERS . " 
				(id_user,
				order_date,
				phone_number,
				comm,
				order_state
				)
				VALUES ('%d','%d','%d','%s','start')";
	$sql = sprintf($sql,
					(int)$id_user,
					(int)$order_date, 
					(int)$phone_number, 
					htmlspecialchars(strip_tags(trim($comm)))
					);
	//echo $sql . "<br>";
	
		if( $result = mysqli_query($link,$sql) ){
			//$ok = "<h2 align=center>Запись о заказе введена успешно</h2>";
		
		// заказ вводится впервые, нужно узнать его id
			$sql = "SELECT 
						id_order 
					FROM 
						" . TABLE_ORDERS . " 
					WHERE  order_date='%d' AND id_user='%d';";
			$sql = sprintf($sql,
					(int)$order_date,
					(int)$id_user
					);
			//echo $sql . '<br>';
			if ($result = mysqli_query($link,$sql)) { 
			
				$row = mysqli_fetch_array($result);  
				$id_order  = $row['id_order']; 
				return $id_order;
				
			}
			else 	 {
				$err .=  "<h3>Невозможно выполнить запрос на выборку id заказа</h3>";
				return false;
			}
		}
		else {
			$err .= "<h3>Невозможно выполнить запрос на сохранение заказа</h3>";
			return false;
		}
		return false;
}


//id_product_in_order,
function add_products_to_order($link, $id_user, $id_order,$id_product, $ammount){

	if (!empty($id_product) && !empty($id_order)) {

		$sql = "INSERT INTO " . TABLE_PRODUCTS_IN_ORDER . " 
				(
				id_order,
				id_product,
				ammount
				)
				VALUES ";
		// массив значений
		$sql_values = '';
		foreach ($id_product as $key => $value) {
			if ($ammount[$key] > 0) {
				$sql_values .= sprintf("('%d','%d','%d'),",(int)$id_order,(int)$value,(int)$ammount[(int)$key]);
			}
		}
		$sql_values = trim($sql_values,',');
		if ($sql_values != '') {
			$sql .= $sql_values;
			//echo $sql . "<br>";

			if ($result = mysqli_query($link,$sql)) {
				//echo "<h2 align=center>Товары в заказ введены успешно</h2>";	
				return true;
			}
			else {
				//echo "<h4 color=red align=center>Невозможно выполнить запрос на сохранение товаров заказа</h4>";
				return false;
			}
		}
		else {
			return false;
		}
	
	}
	else {
		//echo "<h4 color=red align=center>Ошибка. Недостаточно данных для сохранения заказа.</h4>";
		return false;
	}
	
}

//выбрать 1 заказ по дате создания и юзеру (свежесозданный)
// возвращает id заказа
function author_order_id($link,$id_user,$date_of_order) {
	if ( (isset($id_user) && (int)$id_user > 0) && (isset($date_of_order) && (int)$date_of_order > 0) ):
		$sql = "SELECT id_order FROM " . TABLE_ORDERS . " 
							WHERE 
								id_user='%d' 
							AND 
								order_date='%d';";
		$sql = sprintf($sql,(int)$id_user,(int)$date_of_order);
		//echo $sql . "<br>";
		if ($result = mysqli_query($link,$sql)) {
			$row = mysqli_fetch_array($result);
			$id = $row['id_order'];
			if ($id > 0) {
				return $id;
			}
			else {
				return false;
				echo "<h3>нет заказа id_user=$id_user, датой=$date_of_order</h3>";
			}
		}
		else {
		
			//die(mysqli_error($link));
			echo "Невозможно выполнить запрос на выборку заказа";
			return false;
		}
	else: return false; 
		 echo "<h3>некорректные id_user=$id_user, датой=$date_of_order</h3>";
	endif; 
}

// возвращает заказы по id юзера
function author_orders_id_author($link,$id) {
	$sql = "SELECT "
					. TABLE_ORDERS . ".*,SUM("
					. TABLE_PRODUCTS_IN_ORDER . ".ammount * " . TABLE_PRODUCTS . ".price) AS sum 
				FROM " 
					. TABLE_ORDERS . ","
					. TABLE_PRODUCTS_IN_ORDER . ","
					. TABLE_PRODUCTS . 
				" WHERE "
					. TABLE_ORDERS . ".id_order=" . TABLE_PRODUCTS_IN_ORDER . ".id_order
				 AND "
					. TABLE_PRODUCTS . ".id_product=" . TABLE_PRODUCTS_IN_ORDER . ".id_product
				  AND id_user='%d' 
				GROUP BY " . TABLE_ORDERS . ".id_order
				ORDER BY " . TABLE_ORDERS . ".order_date DESC;";
	$sql = sprintf($sql,(int)$id);
	//echo $sql . "<br>";
	if ($result = mysqli_query($link,$sql)) {
		while ($row = mysqli_fetch_array($result)) {
			$orders[] = $row;
		}

		if (isset($orders)) {
			return $orders;
		}
		else {
			echo "<h3>Нет заказов по id юзера</h3>";
			return false;
		}
	}
	else {
		//die(mysqli_error($link));
		echo "<h3>Невозможно выполнить запрос на выборку заказов по id юзера</h3>";
		return false;
	}
}

// возвращает заказы по id юзера
function orders_all($link) {
	$sql = "SELECT "
					. TABLE_AUTHORS . ".id_author,"
					. TABLE_AUTHORS . ".author_login,"
					. TABLE_AUTHORS . ".author_name,"
					. TABLE_AUTHORS . ".author_family,"
					. TABLE_ORDERS . ".*,SUM("
					. TABLE_PRODUCTS_IN_ORDER . ".ammount * " . TABLE_PRODUCTS . ".price) AS sum 
				FROM " 
					. TABLE_AUTHORS . ","
					. TABLE_ORDERS . ","
					. TABLE_PRODUCTS_IN_ORDER . ","
					. TABLE_PRODUCTS . 
				" WHERE "
					. TABLE_AUTHORS . ".id_author=" . TABLE_ORDERS . ".id_user
				AND "
					. TABLE_ORDERS . ".id_order=" . TABLE_PRODUCTS_IN_ORDER . ".id_order
				 AND "
					. TABLE_PRODUCTS . ".id_product=" . TABLE_PRODUCTS_IN_ORDER . ".id_product

				GROUP BY " . TABLE_ORDERS . ".id_order DESC
				ORDER BY " . TABLE_ORDERS . ".id_order DESC;";
		
	//echo $sql . "<br>";
	if ($result = mysqli_query($link,$sql)) {
		while ($row = mysqli_fetch_array($result)) {
			$orders[] = $row;
		}

		if (isset($orders)) {
			return $orders;
		}
		else {
			echo "<h3>Нет заказов </h3>";
			return false;
		}
	}
	else {
		//die(mysqli_error($link));
		echo "<h3>Невозможно выполнить запрос на выборку заказов</h3>";
		return false;
	}
}


//Данные юзера заказа
function user_of_order($link,$id_order) {
	$sql = "SELECT "
					. TABLE_AUTHORS . ".*

				FROM " 
					. TABLE_AUTHORS . ","
					. TABLE_ORDERS . 
				" WHERE "
					. TABLE_AUTHORS . ".id_author=" . TABLE_ORDERS . ".id_user
				AND "
					. TABLE_ORDERS . ".id_order='%d'";
					
	$sql = sprintf($sql,(int)$id_order);
	
	//echo $sql . "<br>";
	if ($result = mysqli_query($link,$sql)) {
		while ($row = mysqli_fetch_array($result)) {
			$user = $row;
		}

		if (isset($user)) {
			return $user;
		}
		else {
			echo "<h3>Не могу найти юзера заказа</h3>";
			return false;
		}
	}
	else {
		//die(mysqli_error($link));
		echo "<h3>Невозможно выполнить запрос на выборку юзера заказа </h3>";
		return false;
	}
}


// возвращает заказ по id заказа
function order_id_order($link,$id) {
	$sql = "SELECT "
					. TABLE_ORDERS . ".*,
						SUM("
					. TABLE_PRODUCTS_IN_ORDER . ".ammount * " . TABLE_PRODUCTS . ".price) AS sum 
				FROM " 
					. TABLE_ORDERS . ","
					. TABLE_PRODUCTS_IN_ORDER . ","
					. TABLE_PRODUCTS . 
				" WHERE "
					. TABLE_ORDERS . ".id_order=" . TABLE_PRODUCTS_IN_ORDER . ".id_order
				 AND "
					. TABLE_PRODUCTS . ".id_product=" . TABLE_PRODUCTS_IN_ORDER . ".id_product 
				 AND "
				 . TABLE_ORDERS . ".id_order='%d';";
					;
	$sql = sprintf($sql,(int)$id);
	//echo $sql . "<br>";
	if ($result = mysqli_query($link,$sql)) {
		$row = mysqli_fetch_array($result);

		if (isset($row))
			return $row;
		else 
			echo "<h3>Невозможно выполнить запрос на выборку заказа по id заказа</h3>";
			return false;
	}
	else {
		
		//die(mysqli_error($link));
		echo "<h3>Невозможно выполнить запрос на выборку заказа по id заказа</h3>";
		return false;
	}
}



// товары в заказе по ID заказа
function products_in_order_id($link,$id) {
	$sql = "SELECT "
					. TABLE_PRODUCTS_IN_ORDER . ".id_product,"
					. TABLE_PRODUCTS_IN_ORDER . ".ammount,"
					. TABLE_PRODUCTS . ".product_name,"
					. TABLE_PRODUCTS . ".price,"
					. TABLE_PRODUCTS . ".photo_thumb
				FROM "
					. TABLE_PRODUCTS_IN_ORDER . ", " . TABLE_PRODUCTS . 
				" WHERE "
					. TABLE_PRODUCTS . ".id_product=" . TABLE_PRODUCTS_IN_ORDER .  ".id_product
				AND " 
					. TABLE_PRODUCTS_IN_ORDER . ".id_order='%d';";
	$sql = sprintf($sql,(int)$id);
	//echo $sql . "<br>";
	if ($result = mysqli_query($link,$sql)) {
		while($row = mysqli_fetch_array($result)) {
			$product[] = $row;
		}

		if (isset($product))
			return $product;
		else {
			//echo "<h3>Ошибка вывада товаров по id заказа</h3>";
			return false;
		}
	}
	else {
		
		//die(mysqli_error($link));
		echo "<h3>Невозможно выполнить запрос на выборку товаров по id заказа</h3>";
		return false;
	}
}


// обновление данных о товаре в заказе по id заказа
function update_product_in_order($link,$id_order,$id_product, $operation) {
	if (!isset($id_order) || !isset($id_product) || !isset($operation)) :
		echo '<h3>Недостаточно данных для ввода</h3>'; 
		return false;
	else:
		if ($operation == '-') {
			$ammount = '-1';
		}
		else {
			$ammount = '+1';
		}
		$sql = "UPDATE " . TABLE_PRODUCTS_IN_ORDER . 
			" SET ammount=(ammount" . $ammount . ")
		WHERE "
			. TABLE_PRODUCTS_IN_ORDER . ".id_product='%d'
		AND "
			. TABLE_PRODUCTS_IN_ORDER . ".id_order='%d';";
					;
		$sql = sprintf($sql,(int)$id_product,(int)$id_order);
		echo $sql . "<br>";
		
		if ($result = mysqli_query($link,$sql)) {
			echo '<h3>Успешное оновление кол-ва товара id в заказе id</h3>'; 
			return true;
		}
		else {
			echo '<h3>Невозможно выполнить запрос на оновление кол-ва товара id в заказе id</h3>'; 
			return false;
		}
		
	endif;
}

// Оплата. обновление данных о заказе по id заказа
function update_order_paid($link,$id_order) {
	if (!isset($id_order)) :
		echo '<h3>Недостаточно данных для ввода</h3>'; 
		return false;
	else:
		
		$sql = "UPDATE " . TABLE_ORDERS  . 
			" SET order_state='paid'
		WHERE id_order='%d'";
					;
		$sql = sprintf($sql,(int)$id_order);
		//echo $sql . "<br>";
		
		if ($result = mysqli_query($link,$sql)) {
			echo '<h3>Успешная оплата</h3>'; 
			return true;
		}
		else {
			echo '<h3>Проблемы с оплатой в заказе id</h3>'; 
			return false;
		}
		
	endif;
}

// Отмена. обновление данных о заказе по id заказа
function update_order_cancel($link,$id_order) {
	if (!isset($id_order)) :
		echo '<h3>Недостаточно данных для ввода</h3>'; 
		return false;
	else:
		
		$sql = "UPDATE " . TABLE_ORDERS  . 
			" SET order_state='cancel'
		WHERE id_order='%d'";
					;
		$sql = sprintf($sql,(int)$id_order);
		//echo $sql . "<br>";
		
		if ($result = mysqli_query($link,$sql)) {
			echo '<h3>Заказ отменён</h3>'; 
			return true;
		}
		else {
			echo '<h3>Ошибка изменения статуса. Заказ не отменен.</h3>'; 
			return false;
		}
		
	endif;
}



// Выполнен. обновление данных о заказе по id заказа
function update_order_finish($link,$id_order) {
	if (!isset($id_order)) :
		echo '<h3>Недостаточно данных для ввода</h3>'; 
		return false;
	else:
		
		$sql = "UPDATE " . TABLE_ORDERS  . 
			" SET order_state='finished'
		WHERE id_order='%d'";
					;
		$sql = sprintf($sql,(int)$id_order);
		//echo $sql . "<br>";
		
		if ($result = mysqli_query($link,$sql)) {
			echo '<h3>Заказ выполнен</h3>'; 
			return true;
		}
		else {
			echo '<h3>Ошибка изменения статуса. Заказ не отменен.</h3>'; 
			return false;
		}
		
	endif;
}


 // удаление товара из заказа
function del_product_in_order($link,$id_order, $id_product) {
	if (!isset($id_order) || !isset($id_product)) :
	echo '<h3>Недостаточно данных для ввода</h3>'; 
		return false;
	else:
	$sql = "DELETE
				FROM " . TABLE_PRODUCTS_IN_ORDER . 

		" WHERE "
			. TABLE_PRODUCTS_IN_ORDER . ".id_product='%d'
		AND "
			. TABLE_PRODUCTS_IN_ORDER . ".id_order='%d';";
					;
		$sql = sprintf($sql,(int)$id_product,(int)$id_order);
		//echo $sql . "<br>";
		
		if ($result = mysqli_query($link,$sql)) {
			echo "<h3>Успешное удаление товара $id_product в заказе $id_order</h3>"; 
			
			//проверяем, остались ли товары в заказе
			$sql = "SELECT count(id_product) AS count_id_product
						FROM " . TABLE_PRODUCTS_IN_ORDER . 
					" WHERE "
						. TABLE_PRODUCTS_IN_ORDER . ".id_order='%d';";
					;
			$sql = sprintf($sql,(int)$id_order);
			//echo $sql . "<br>";
			
			$count_id_product = 1;
			$result = mysqli_query($link,$sql) or die('<h3>Невозможно выполнить выборку товаров по id заказа</h3>')	;	
			while($row = mysqli_fetch_array($result)) {
				$count_id_product = $row['count_id_product'];
			}
			
			if ($count_id_product == 0) {
				echo '<h3>Нет товаров в заказе</h3>';
				del_order($link,$id_order);
			}

		return true;
		}
		else {
			echo "<h3>Невозможно выполнить запрос на удаление товара $id_product в заказе $id_order</h3>"; 
			return false;
		}
		
	endif;
}

//удаление заказа 
function del_order($link,$id_order) {
	if (!isset($id_order)) :
		echo '<h3>Недостаточно данных для ввода</h3>'; 
		return false;
	else:
		$sql = "DELETE
				FROM " . TABLE_ORDERS . 
			" WHERE id_order='%d';";

		$sql = sprintf($sql,(int)$id_order);
		//echo $sql . "<br>";
		
		if ($result = mysqli_query($link,$sql)) {
			echo "<h3>Успешное удаление заказа $id_order</h3>"; 
			
			//удаление товаров заказа
			$sql = "DELETE
				FROM " . TABLE_PRODUCTS_IN_ORDER . 

				" WHERE 
					id_order='%d';";
			$sql = sprintf($sql,(int)$id_order);
			//echo $sql . "<br>";
		
			if ($result = mysqli_query($link,$sql)) {
				echo "<h3>Успешное удаление товаров из заказа $id_order</h3>"; 
				return true;
			}
			else {
				echo "<h3>Невозможно удаление товаров из заказа $id_order</h3>"; 
			}
		}
		else {
			echo "<h3>Невозможно выполнить запрос заказа $id_order</h3>"; 
			return false;
		}
		
	endif;	
	
}


?>