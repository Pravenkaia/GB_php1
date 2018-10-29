<?
include("engine/calculating.php");  			// обработка форм и значений
$tpl  = file_get_contents("tpl/header.php");    //  шаблон заголовка
if     ($_GET['form'] == 'btn')     			// выбор формы
	$tpl .= file_get_contents("tpl/form_buttons.php");  // кнопочный ввод
elseif ($_GET['form'] == 'slct') 
	$tpl .= file_get_contents("tpl/form_select.php");   // селекттовый ввод

//  обработка данных в шаблонах 
// образцы в шаблонах	
$patterns = array( '/{title}/', '/{h1}/', '/{results}/', '/{figure1}/', '/{figure2}/');  
// переменны для замены образцов
$replace = array( $title, $h1, $results, $figure1, $figure2 );   
//  заменяем шаблоны данных значениями                        
echo preg_replace( $patterns, $replace, $tpl );

include ("tpl/footer.php");  // шаблон подвала
?>
