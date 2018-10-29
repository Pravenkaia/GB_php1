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
		
		
		include('../templates/form_error_log.php');

	else : 
		//echo "Все хорошо";
		$log = htmlspecialchars(strip_tags(trim($_POST['author_login'])));
		$pas = htmlspecialchars(strip_tags(trim($_POST['author_pass'])));
		
		//получаем id пользователя его права, если верны пароль и логин
		// проверка наличия в базе по логину и паролю
		// возвращает массив $user: $user['id'], $user['rights']
		$user = authors_get_id_and_rights($connection, $log, $pas); 
		
		//организуем сессию, если есть такой юзер
		if (isset($user['id']) && $user['id'] > 0) {
			
			session_start();
			$_SESSION ['permit_s'] = 'yes';
			$ses = session_id();
			setcookie("ses", $ses, 0,'/'); // сохраняем сессию в куках
			setcookie("id_author", $user['id'], 0 ,'/');  // id юзера
			setcookie("id_author_rights", $user['rights'], 0 ,'/');  // права юзера
			
			header ("Location: /users/");
			exit;
		}
		else {
			$errors = '<h3>Неверный логин или пароль</h3>';
			include('../templates/form_error_log.php');
		}
	

	endif;

	
endif;
?>
