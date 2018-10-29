<?
// Выбор формы ввода // кликом по меню навигации
if (!isset($_GET['form'])) {  
	$title = 'Выберите Куркулятор';
}
else {
	if ($_GET['form'] == 'btn') {
		$title = 'Кнопочный Куркулятор';
	}
	else {
		$title = 'Куркулятор с селектом';
	}
}
$h1 = $title;
// значения по умолчанию
$results = '';
$figure1 = '';
$figure2 = '';

// Проверка ввода
if($_SERVER['REQUEST_METHOD'] == 'POST')	{
	if (	
		isset($_POST['operation'])
		&&
		( isset($_POST['figure1']) && is_numeric($_POST['figure1']) )
		&&
		( isset($_POST['figure2']) && is_numeric($_POST['figure2']) )
	) {
		// все введенные данные верны
		include("engine/functions.php");  // библиотека арифметических операций
		$results = mathOperation($_POST['figure1'],$_POST['figure2'], $_POST['operation']);
		$figure1 = $_POST['figure1'];
		$figure2 = $_POST['figure2'];
	}
	else {
		// 
		$h1 = 'Ошибка ввода';
	}	
}

	
?>