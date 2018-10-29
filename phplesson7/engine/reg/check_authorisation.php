<?
session_start();
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	session_destroy();
	header ("Location: /");
	exit;

else:

include('../config/common.php');
include('../engine/functions_db.php');

	

	//Проверка заполнения полей
	$mes = array(); 

	if (!isset($_POST['author_login'])  ||  htmlspecialchars(strip_tags(trim($_POST['author_login']))) == '' )  {
		$mes[]='Не заполнено поле "Логин"';
	}

	if (!isset($_POST['author_pass'])   ||  htmlspecialchars(strip_tags(trim($_POST['author_pass'])))  == '')   {
		$mes[]='Не заполнено поле "Пароль"';
	}


	$errForm = ''; // Форма ошибок
	$errors = '';  // ошибки ввода
	$insert = '';  // добавление автора в бд
		
	if (count($mes)>0) : 

		
		for ($j=0;$j < count($mes);$j++)   
		{ $errors .= '<h4>' . $mes[$j] . '</h4>'; }
	
		$errForm = '
				<div>
				<form method=POST ACTION="index.php" ENCTYPE="multipart/form-data">

				<input type=hidden name=author_login  	 value="' . htmlspecialchars(strip_tags(trim($_POST['author_login']))) . '" >

				<input type=submit value="Вернуться к информации">
				</form>
				</div>';



	else : 
		//echo "Все хорошо";
		$log = htmlspecialchars(strip_tags(trim($_POST['author_login'])));
		$pas = htmlspecialchars(strip_tags(trim($_POST['author_pass'])));
		
		$id = authors_get_id($connection, $log, $pas);
		
		$errors = '';
		if ($id > 0) {
			session_start();
			$_SESSION ['permit_s'] = 'yes';
			$ses = session_id();
			setcookie("ses", $ses, 0,'/');
			setcookie("id_author", $id, 0 ,'/');
			header ("Location: /users/");
			exit;
		}
		else {
			$errors = '<h3>Неверный логин или пароль</h3>';
		}
	

	endif;

	
endif;
?>
