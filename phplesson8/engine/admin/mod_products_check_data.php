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
?>