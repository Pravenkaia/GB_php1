<?
	
function delfile ($file_name)
	{
		if (file_exists($_SERVER["DOCUMENT_ROOT"] . $file_name)) {
			if (unlink($_SERVER["DOCUMENT_ROOT"] . $file_name) === true) {
				return true;
			} 
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

// фунция проверки файла. Картинка ли он. Да и есть ли он вообще
// возвращает false в случае неудачи,
// в случае удачи возвращает расширение файла (.gif, например)
	function isImg($img)	{ 
		if (isset($img) && $img != "") {
		//проверка типа файла	
			$fTypePic = mime_content_type($img); 
			$fTypePic = strtolower($fTypePic);  //к нижнему регистру
		
		//image/gif, image/png, image/jpeg

			if ($fTypePic != 'image/gif' && $fTypePic != 'image/png' && $fTypePic != 'image/jpeg') {
				echo "<h5>Ошибка, тип файла:   $fTypePic </h5>";
				return false;
			}
			else {
				//echo 'Верно, тип файла: ' . $fTypePic . '<br>';
				// задаем унифицированное расширение файла (а не .JPEG, .Png и т.п.)
				switch($fTypePic) {
					case 'image/gif':
						$fTypePic = ".gif"; 
						break;
					case 'image/png':
						$fTypePic = ".png";
						break;
					default :
						$fTypePic = ".jpg";
				};
				
				return $fTypePic;  // возвращает расширение файла, // не возвращает mime-тип файла
			}
		}
		else {
			return false;
		}
	} // конец // фунция проверки файла. Картинка ли он. Да и есть ли он вообще
	///////////////////////////////////////////////////////////////////
	

	
	/////////////////////////////////////////////////////////////////
	//функция транслитерации названия файла
	function translitUrlFor($str) {
		// Транслитерация заголовков для url
		// без регулярных выражений
		// совместимая с  PHP5.6
		$str = mb_strtolower($str,'utf8'); // к нижнему регистру в кодировке utf8 (совместимость с PHP5.6)

		$letters = [
			'а'=> 'a',	 'б' => 'b',  'в' => 'v',  'г' => 'g',	'д' => 'd',  'е' => 'e', 
			'ё' => 'e',	 'ж' => 'j',  'з' => 'z',  'и' => 'i',  'й' => 'y',  'к' => 'k', 
			'л' => 'l',	 'м' => 'm',  'н' => 'n',  'о' => 'o',  'п' => 'p',  'р' => 'r', 
			'с' => 's',	 'т' => 't',  'у' => 'u',  'ф' => 'f',  'х' => 'h',  'ц' => 'ts', 
			'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh', 'ы' => 'i','э' => 'e',  'ю' => 'yu', 'я' => 'ya', 'ь' => '', 'ъ' => '',
		
			'a' => 'a',  'b' => 'b', 'c' => 'c', 'd' => 'd', 'e' => 'e', 'f' => 'f', 'g' => 'g',
			'h' => 'h',  'i' => 'i', 'j' => 'j', 'k' => 'k', 'l' => 'l', 'm' => 'm', 'n' => 'n',
			'o' => 'o',  'p' => 'p', 'q' => 'q', 'r' => 'r', 's' => 's', 't' => 't', 'u' => 'u',
			'v' => 'v',  'w' => 'w', 'x' => 'x', 'y' => 'y', 'z' => 'z',
			1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9
			
		];
	
		for ($i = 0,$arr = []; $i < strlen($str); $i++) {
			$isFound =0; // если не обнаружен элемент массива 
			foreach ($letters as $key => $value) {
				// explode php 5.6 для строк в кодировке UTF8 не работает, str_split работает с регулярными выражениями.
				// поэтому ввожу новую переменную -- массив arr
				
				if (mb_substr($str,$i,1,'utf8') == $key) { // сравниваем подстроку длиной в 1 символ с i-й позиции в кодировке utf8 (совместимость с PHP5.6)
					$arr[$i] = $value; //пополняем массив новых значений
					$isFound = 1; // обнаружено совпадение, пополняем массив новых значений
				}
			}
			if ($isFound == 0) { // не обнаружено совпадение
				$arr[$i] = '_'; //заменяем все НЕбуквы подчеркиваниями
			}
		}
		$str = implode($arr);
		$str = trim($str,'_'); // обрезаем - в конце и в начале строки

		while ( stripos($str,'__') !== false) { // замена всех дублирующихся подчеркиваний
			$str = str_replace('__', '_',$str);
		}
	
		return $str;
	}  // конец //функция транслитерации названия файла
	///////////////////////////////////////////////////////////////////
	
	
	
	
	/////////////////////////////////////////////////////
	// функция загрузки изображений. Возвращает имя файла в папке 
	function loadImg(
		$img,        // временное имя файла  изображения
		$imgName,    // имя исходного файла  изображения
		$fTypePic,   // унифицированное расширение файла
		$fold   	 // папка для файлов  изображений
	) {
		
		// Загрузка изображения
		if (($fTypePic = isImg($img)) == false) :  // проверка файла изображения
			return false;
		else:

			$uploadDir = $_SERVER["DOCUMENT_ROOT"] .  $fold; //
			$imgFname  = translitUrlFor($imgName); //транслитерация с подчеркиваниями
			$imgFname .= $fTypePic; //  добавляем новое расширение

			//echo '<br>$imgFname=' . $imgFname . '<br>';
	   
			//загрузка без изменения размеров
				if (move_uploaded_file($img,$uploadDir . $imgFname)) {
					//echo "<p align=center>Файл изображения  $imgFname успешно загружен в $uploadDir</p>"; 
					return $imgFname;
				}
				else {
					//echo "<h4 align=center color=red>Ошибка загрузки файла $imgFname в $fold</h4>"; 
					return false; 
				}
		endif;
	}  // конец // функция загрузки изображений. Возвращает имя файла в папке 
	////////////////////////////////////////////////////////
	
	
	/////////////////////////////////////////////////////
	// функция копирования изображения в другую папку. Возвращает имя файла в папке
	function copyFile(
		$fromFold,   // исходная папка
		$toFold,     //  целевая папка
		$imgFnameFrom, // имя файла в папке исходное
		$imgFnameTo    // имя файла в папке конечное
	) {

		// проверерка, существуют ли файл исходный и целевая директория
		if (
			file_exists($_SERVER["DOCUMENT_ROOT"] . $fromFold . $imgFnameFrom) // существует ли файл исходный
			&& file_exists($_SERVER["DOCUMENT_ROOT"] . $toFold)        			// существует ли целевая директория
		) {
			//копирование файла в новое место
			
			if(copy(   
				$_SERVER["DOCUMENT_ROOT"] . $fromFold . $imgFnameFrom ,
				$_SERVER["DOCUMENT_ROOT"] . $toFold . $imgFnameTo 
			)) {
				return $imgFnameTo;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}  // конец // функция копирования изображения в другую папку.
	/////////////////////////////////////////////////////////////////
	
	
	
	
	////////////////////////////////////////////////////
	// функция масштабирования размеров
	function resizeImg(
		$imgFname,    // имя файла
		$fold,   // папка для больших изображений
		$max_width       //  максимальная высота больших картинок  = 600
	) {

				// Проверка размера картинки

				//получаем информацию о файле в массив
				if (file_exists($_SERVER["DOCUMENT_ROOT"] . $fold . $imgFname)) {
					$fInfo = getimagesize($_SERVER["DOCUMENT_ROOT"] . $fold . $imgFname);
				}
				else {
					return false;
				}
				
				
				
				// cравниваем с размером бдущего изображения
				if ($fInfo[0] > $max_width )	 { 
					
					//Создаем обьект Image Magic
					$thumb1 = new Imagick();
					//"Читаем" изображение        
					$thumb1->readImage($_SERVER['DOCUMENT_ROOT'] . $fold . $imgFname);
				
					// теперь меняем размер
					$w = $max_width;  	//ширина нового изображения
					$h = ceil($fInfo[1] * $h / $fInfo[0]); // высота нового изображения
						// изображение с новыми размерами
					$thumb1->thumbnailimage($w,$h); 

					$thumb1->writeImage(); //записываем файл на диск
				
					$thumb1->clear();  //уничтожаем объект
				}
			return $imgFname;	
	}  //конец  // функция масштабирования размеров
	////////////////////////////////////////////////////////


/*	
	//////////////////////////////////////////////////////////////////
	// Функция сохранения в базу данных
	function placePhotoBD(
		$id_photo,
		$pathBig,  //путь к большому файлу
		$pathThumb,  // путь к превьюшке
		$photoAlt  // подпись к картинке
	) 	{

		$err = '';
		if ($id_photo == '' || !is_integer($id_photo))
			$id_photo = 'NULL';
		$photoAlt = str_replace("'", '&prime;',$photoAlt);
		$photoAlt = str_replace('"', '&quot;',$photoAlt);
		$sql = "REPLACE INTO " .
						$GLOBALS['table_photos']  . "
							(
							id_photo,
							photo_big,
							photo_thumb,
							photo_alt
							) 
						VALUES (" . 
							$id_photo . ",'" .
							$pathBig . "','" .
							$pathThumb . "','" . 
							$photoAlt 
							. "');";
			//echo $sql . "<br>";  
			$result = mysqli_query($GLOBALS['connection'],$sql) or die($err = "Невозможно выполнить запрос на добавление  в базу данных");
	
			if ($err != '') {return false;}
			//else { echo '<p align=center><font class=bold>Сохранение данных прошло успешно!</font></p>';}
			
			mysqli_close($GLOBALS['connection']);

		return true;
	}
	// Функция сохранения в базу данных
	////////////////////////////////////////////////
	
	
	
	//////////////////////////////////////////////////////////////////////
	// Конфигурация папок изображений
	//$foldBig = '/img/big/';  
	//$foldThumbs = '/img/thumb/';

	foreach($_FILES['fileLoad']['tmp_name'] as $key => $value) { //  проходим по массиву загруженных файлов
		
		//echo $value;
		
		if (($fTypePic = isImg($value)) != false) {  // проверка файла изображения // получаем унифицированное расширение файла
			
			// Загрузка изображения // вызов функции
			$imgFname = loadImg(  //новое имя файла
				$value,        // временное имя исходного файла  изображения
				$_FILES['fileLoad']['name'][$key],    // имя исходного файла  изображения
				$fTypePic,   // унифицированное расширение файла
				$foldBig   	 // папка для файлов  изображений
			);
			if ($imgFname  != false) {  //получили имя файла с транслитерацией символов
				// успешная загрузка файла
				
				////////////////////////////////
				//копирование и масштабирование файла в папку превьюшек

				if (($imgFnameThumb = copyFile(  // копирование thumb
						$foldBig,   // исходная папка
						$foldThumbs,     //  целевая папка
						$imgFname, // имя файла в папке исходное
						$imgFname    // имя файла в папке конечное
					)) != false 
				) {

					//масштабирование превьюшек
					if (($imgFnameThumb = resizeImg(
						$imgFnameThumb,    // имя файла
						$foldThumbs,   // папка 
						150       //  максимальная высота
					)) != false) {
						echo '<h5>Успешное масштабирование файла thumb ' . $foldThumbs . $imgFnameThumb . '</h5>'; 
						
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
				
				///////////////////////////////////////////////////
				
				
				//////////////////////////////
				if ($imgFname != '' && $imgFname != '' && $foldThumbs != '' && $imgFnameThumb != '') {

					// сохраняем в базе данных
					if ( placePhotoBD(
								'', 
								$foldBig . $imgFname, 
								$foldThumbs . $imgFnameThumb, 
								$_POST['altFile'][$key] 
								)) {
						echo '<h5>Успешное сохранение в БД</h5>';
					}
					else {  // сохраняем в базе данных
						echo '<h5>Ошибка сохранения в БД</h5>';
					}	 
					
				}
				else {  // сохраняем в базе данных
						echo '<h5>Проблемы с путями к файлам! Данные не сохранены в БД</h5>';
				}
				///////////////////////////
				
				
				//////////////////////////
				//
				
				//
				/////////////////////////////
			}
			else {  // загрузка файла изображения
				echo '<h5>Ошибка загрузки файла изображения ' . $_FILES['fileLoad']['name'][$key] . '</h5>';
			}
		}
		else {  // проверка файла изображения
			echo '<h5>Файл ' . $_FILES['fileLoad']['name'][$key] . ' не web-изображение!</h5>';
		}
	}
*/
?>
