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

	if (!isset($_POST['author_name'])   ||  htmlspecialchars(strip_tags(trim($_POST['author_name']))) == '')   {
		$mes[]='Не заполнено поле "Имя"';
	}
	if (!isset($_POST['author_family']) ||  htmlspecialchars(strip_tags(trim($_POST['author_family']))) == '' ) {
		$mes[]='Не заполнено поле "Фамилия"';
	}
	if (!isset($_POST['author_email'])  ||  strip_tags(trim($_POST['author_email'])) == '' )  {
		$mes[]='Не заполнено поле "email"';
	}

	if (!isset($_POST['author_login'])  ||  htmlspecialchars(strip_tags(trim($_POST['author_login']))) == '' )  {
		$mes[]='Не заполнено поле "Логин"';
	}
	else {
		if(  !preg_match("/^[a-zA-Z0-9_-]{3,}$/",trim($_POST['author_login']) ) ) {
				$mes[]='Логин может содержать только латинские буквы, цифры, знаки "_", "-". ';
		}
		// Проверка существования логина. ДУБЛЬ!!
		else {
			if($count = authors_get($connection, trim($_POST['author_login']))) {
					$mes[]='Такой логин уже есть!!!!';
			}
		}
		
	}
	if (!isset($_POST['author_pass'])   ||  htmlspecialchars(strip_tags(trim($_POST['author_pass'])))  == '')   {
		$mes[]='Не заполнено поле "Пароль"';
	}
	else {
		if(  !preg_match("/^[a-zA-Z0-9_-]{8,16}$/",trim($_POST['author_pass']) ) ) {
			$mes[]='Пароль может содержать только латинские буквы, цифры, знаки "_", "-".<br> Должен быть не меньше 8 символов, но не больше 16';
		}
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
				<input type=hidden name=author_name      value="' . htmlspecialchars(strip_tags(trim($_POST['author_name']))) . '" >
				<input type=hidden name=author_family    value="' . htmlspecialchars(strip_tags(trim($_POST['author_family']))) . '" >
				<input type=hidden name=author_login  	 value="' . htmlspecialchars(strip_tags(trim($_POST['author_login']))) . '" >
				<input type=hidden name=author_email     value="' . strip_tags(trim($_POST['author_email'])) . '" >

				<input type=submit value="Вернуться к информации">
				</form>
				</div>';



	else : 
		//echo "Все хорошо";

		$rights = 3; // права юзера
		$date_reg = time();
		$insert = authors_insert($connection, 
							$rights,
							htmlspecialchars(strip_tags(trim($_POST['author_name']))),
							htmlspecialchars(strip_tags(trim($_POST['author_family']))),
							htmlspecialchars(strip_tags(trim($_POST['author_login']))),
							htmlspecialchars(strip_tags(trim($_POST['author_pass']))),
							strip_tags(trim($_POST['author_email'])),
							$date_reg);


	endif;

	
endif;
?>
