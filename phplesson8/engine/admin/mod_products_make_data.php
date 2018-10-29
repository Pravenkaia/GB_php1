<?
//проверка администратора
include('../../engine/session_check_admin.php');

	
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
						$ok = 'Успешное масштабирование файла thumb ' . $foldThumbs . $imgFnameThumb;
						include('../../templates/ok.php');						
						// для сохранения в базу данных
						$photo_thumb_bd = $foldThumbs . $imgFnameThumb;
						$photo_big_bd   = $foldBig    . $imgFname;
					}
					else {
						$error = 'Ошибка масштабирования файла thumb ' . $foldThumbs . $imgFname;
						include('../../templates/error.php');						
					}
					
				}
				else {  // копирование thumb
						$error = 'Ошибка копирования файла thumb ' . $foldThumbs . $imgFname;
						include('../../templates/error.php');
				}
				////////////////////////////////	
					
				
				/////////////////////////////////////
				// масштабирование огромных файлов в папку $foldBig
				

				if (($imgFname = resizeImg(
					$imgFname,    // имя файла
					$foldBig,   // папка 
					450       //  максимальная высота
					)) != false) {
						$ok = 'Успешное масштабирование файла большого ' . $foldBig . $imgFname;
						include('../../templates/ok.php');		
				}
				else {
					$error = 'Ошибка масштабирования файла большого ' . $_FILES['fileLoad']['name'][$key];
					include('../../templates/error.php');					
				}
				
			}
			else {  // загрузка файла изображения
				$error = 'Ошибка загрузки файла изображения ' . $_FILES['fileLoad']['name'][$key]; 
				include('../../templates/error.php');
			}

		}
?>