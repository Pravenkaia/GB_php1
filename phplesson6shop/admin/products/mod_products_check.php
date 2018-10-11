<?
if($_SERVER['REQUEST_METHOD'] != 'POST') : { // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	header ("Location: /");
	exit;
}
else:

	include('../../config/common.php');
	include('../../engine/files.php');

	$h1 = "Добавление товара: проверка данных";
	$title = $h1;
	include('../../templates/header.php');

?>
	<main>
<?	

	//Массив ошибок
	$mes = array(); 

	//Проверка заполнения полей


	if (!isset($_POST['product_name'])  || htmlspecialchars(strip_tags($_POST['product_name'] == '')) )  {
		$mes[]='Не заполнено поле "Название товара"';
	}
	if ( !isset($_POST['id_group']) || count($_POST['id_group']) == 0)  {
		$mes[]='Укажите ГРУППУ для товара!!!!!'; 
	}
	if ( !isset($_POST['price']) || (int)$_POST['price'] == 0  )  {
		$mes[]='Цена должна быть числом (без пробелов и букв)'; 
	}
	
	// Проверка изображения

	if (
		( !isset($_POST['photo_thumb']) && !isset($_POST['photo_big']) )  //нет прежних изображений
		&&
		(!isset($_FILES['photo']['tmp_name'])) // нет новых изображений
		) {
		$mes[]='Не выбрана картинка!';
	}
	else {
		// проверка файла изображения // получаем унифицированное расширение файла
		if (isset($_FILES['photo']['tmp_name']) && $_FILES['photo']['tmp_name'] != "") {
			if (($fTypePic = isImg($_FILES['photo']['tmp_name'])) == false)
			$mes[]='Неверный тип файла картинки';
		}
	}
	
		//Вывод ошибок заполнения
	if (count($mes)>0) :  // if 2 контроль ошибок ввода
		
		$j=0;  while ($j < count($mes))   { echo '<h4 align=center>' . $mes[$j] . '</h4>'; $j++; }

?>

		<div align=center>
			<form method=POST ACTION="mod_products_show.php" ENCTYPE="multipart/form-data">
<?
				if (isset($_POST['id_group']) && count($_POST['id_group']) > 0) {
					foreach($_POST['id_group'] as $key => $value) {
						echo '<input type=hidden name="id_group[]" value="' . $value . '" >';
					}
				}
?>			
				<input type=hidden name=full_form  value='1' >
				<input type=hidden name=id_redact    	value='<? if (isset($_POST['id_redact']) && $_POST['id_redact'] > 0) 		echo $_POST['id_redact']; ?>' >

				<input type=hidden name=price    		value='<? if (isset($_POST['price'])) 		echo (int)$_POST['price']; ?>' >

				<input type=hidden name=product_name    value='<? if (isset($_POST['product_name']))  echo htmlspecialchars(strip_tags(str_replace("'","&#39;",trim($_POST['product_name']))));  ?>' >
				<input type=hidden name=product_text    value='<? if (isset($_POST['product_text']))  echo htmlspecialchars(strip_tags(str_replace("'","&#39;",trim($_POST['product_text']))));  ?>' >

				<input  type=submit value="   Вернуться к вводу информации   ">
			</form>
		</div>
<?

	else: // if 2 контроль ошибок ввода
	
		//echo "ВСЕ ХОРОШО";  
		
		
			
		if (isset($_POST['id_redact']) && $_POST['id_redact'] > 0)
			$id_redact_bd = $_POST['id_redact'];
		else 
			$id_redact_bd = '';
				
		
		if (isset($_POST['price']))
			$price_bd = (int)$_POST['price'];
		else
			$price_bd = '';
		
		if (isset($_POST['product_name']))  
			$product_name_bd = htmlspecialchars(strip_tags(str_replace("'","&#39;",trim($_POST['product_name']))));
		else
			$product_name_bd = '';
		
		if (isset($_POST['product_text']))
				$product_text_bd = htmlspecialchars(strip_tags(str_replace("'","&#39;",trim($_POST['product_text']))));
		else
			$product_text_bd = '';
				

		
  // группы товара
			$id_group_bd = array();
			if (isset($_POST['id_group']) && count($_POST['id_group'])  > 0 )  {
				$j = 1; 
				foreach ($_POST['id_group'] as $id_group_exist) {
					$id_group_bd[$j] = $id_group_exist; //echo '$id_group_bd[' . $j . ']= ' . $id_group_bd[$j] . '<br>';
					$j++;
				}  
			}	
	// картинки товара
	$photo_big_bd = '';
	
	if (isset($_POST['photo_big'])) 
			$photo_big_bd = $_POST['photo_big'];
	else 
			$photo_big_bd = '';
	
	if (isset($_POST['photo_thumb'])) 
			$photo_thumb_bd = $_POST['photo_thumb'];
	else 
			$photo_thumb_bd = '';
	
		if ($fTypePic != '') {
			
			//удаление прежних файлов
			if ($photo_thumb_bd != '') 
					delfile($photo_thumb_bd);
			if ($photo_big_bd!= '') 
					delfile($photo_big_bd);
			
			// Загрузка изображения // вызов функции
			$imgFname = loadImg(  //новое имя файла
				$_FILES['photo']['tmp_name'],        // временное имя исходного файла  изображения
				$product_name_bd,    // имя исходного файла  изображения
				$fTypePic,   // унифицированное расширение файла
				$foldBig   	 // папка для файлов  изображений
			);
			
			if ($imgFname  !== false) {  //получили имя файла с транслитерацией символов
				// успешная загрузка файла
				
				////////////////////////////////
				//копирование и масштабирование файла в папку превьюшек

				if (($imgFnameThumb = copyFile(  // копирование thumb
						$foldBig,   // исходная папка
						$foldThumbs,     //  целевая папка
						$imgFname, // имя файла в папке исходное
						$imgFname    // имя файла в папке конечное
					)) !== false 
				) {

					//масштабирование превьюшек
					if (($imgFnameThumb = resizeImg(
						$imgFnameThumb,    // имя файла
						$foldThumbs,   // папка 
						150       //  максимальная ширина
					)) !== false) {
						echo '<h5>Успешное масштабирование файла thumb ' . $foldThumbs . $imgFnameThumb . '</h5>'; 
						// для сохранения в базу данных
						$photo_thumb_bd = $foldThumbs . $imgFnameThumb;
						$photo_big_bd   = $foldBig    . $imgFname;
					}
					else {
						echo '<h5>Ошибка масштабирования файла thumb ' . $foldThumbs . $imgFname . '</h5>'; 
					}
					
				}
				else {  // копирование thumb
						echo '<h5>Ошибка копирования файла thumb ' . $foldThumbs . $imgFname . '</h5>'; 
				}
				////////////////////////////////	
					
				
				/////////////////////////////////////
				// масштабирование огромных файлов в папку $foldBig
				

				if (($imgFname = resizeImg(
					$imgFname,    // имя файла
					$foldBig,   // папка 
					450       //  максимальная высота
					)) != false) {
						echo '<h5>Успешное масштабирование файла большого ' . $foldBig . $imgFname . '</h5>'; 
				}
				else {
					echo '<h5>Ошибка масштабирования файла большого ' . $_FILES['fileLoad']['name'][$key] . '</h5>'; 
				}
				
			}
			else {  // загрузка файла изображения
				echo '<h5>Ошибка загрузки файла изображения ' . $_FILES['fileLoad']['name'][$key] . '</h5>';
			}

		}
		
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
		$err = "<h2 align=center>Запись о товаре введена успешно</h2>";		
		$result = mysqli_query($connection,$sql) or die($err = "Невозможно выполнить запрос на сохранение товара");

		echo "<h4 color=red align=center>" . $err . "</h4>";
		
		// если товар вводится впервые, нужно узнать его id
		if ($id_redact_bd == '') {
			$sql = "SELECT * FROM $table_products WHERE  product_time='" . $product_time_bd . "' AND product_name=' . $product_name_bd . ';";
			$result = mysqli_query($connection,$sql) or die($err[] = "Невозможно выполнить запрос на выборку товаров");
			while ($row = mysqli_fetch_array($result))  {
				$id_redact_bd  = $row['id_product'];
			}
		}
		//теперь можно сохранить группы товара в БД
		if ($id_redact_bd > 0) {
				//удаление устаревших связей с группами  из uid_groups
				$sql = "DELETE  FROM $table_uid_groups WHERE id_product=" . $id_redact_bd;
				//echo $sql . "<br>";
				$err = '';
				$result = mysqli_query($connection,$sql) or die($err = "Невозможно выполнить запрос на удаление устаревших связей из uid_catalog");
				if ($err != '')  echo "<h4 color=red align=center>" . $err . "</h4>";
				
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
						$err = '';
						$result = mysqli_query($connection,$sql) or die($err = "Невозможно выполнить запрос на добавление связей в uid_catalog");
						if ($err != '')  echo "<h4 color=red align=center>" . $err . "</h4>";
						}
		}
			
	endif;  // if 2 контроль ошибок ввода
	
?>
	</main>
<?
	include('../../templates/footer.php');
endif;// if: 1 SERVER['REQUEST_METHOD'] != 'POST'



?>
