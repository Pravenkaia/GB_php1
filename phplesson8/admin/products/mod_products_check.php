<?
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	header ("Location: /");
	exit;

else:
//проверка админа
include('../../engine/session_check_admin.php');
endif;// if: 1 SERVER['REQUEST_METHOD'] != 'POST'


	include('../../config/common.php');
	// модуль загрузка файлов
	include('../../engine/files.php');  
	// проверка ввода данных
	include('../../engine/admin/mod_products_check_data.php'); // проверка
	$h1 = "Добавление товара: проверка данных";
	$title = $h1;
	include('../../templates/header.php');

?>
	<main>
<?	

	
		//Вывод ошибок заполнения
	if (count($mes)>0) :  // if 2 контроль ошибок ввода
		
		$j=0;  while ($j < count($mes))   { 
			$error = $mes[$j]; 
			include('../../templates/error.php');
			$j++; 
		}
		// форма возврата к редактированию товара
		include('../../templates/form_mod_products_error.php');



	else: // if 2 контроль ошибок ввода
	
		//echo "ВСЕ ХОРОШО";  
		
		// подготовка данных для сохранения
		// загрузка файлов
		include('../../engine/admin/mod_products_make_data.php'); 
		include('../../engine/admin/mod_products_save_data.php'); 
		
		
		
			
	endif;  // if 2 контроль ошибок ввода
	
?>
	</main>
<?
	include('../../templates/footer.php');




?>
