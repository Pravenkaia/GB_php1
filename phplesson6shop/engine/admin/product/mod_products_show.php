<?
if   (isset($_POST['id_redact']) && $_POST['id_redact'] > 0)  $h1 = "Редактирование товара";
else                		 								  $h1 = "Добавление товара";
$title = $h1;

// переменные товара
		$id_group_this = array();
	
		$id_product_this     = '';
		$product_name_this   = '';
		$product_text_this   = '';
		$count_id_group_this = ''; //кол-во групп товара
		$price_this          = '';
		$photo_big_this      = '';
		$photo_thumb_this    = '';
		$photo_on_page 					= '';
		$err[] 				 = '';  // ошибки

// Выборка товара
if (isset($_POST['id_redact']) && $_POST['id_redact'] !='') {
	
	
	$sql = "SELECT * FROM $table_products WHERE  id_product='" . $_POST['id_redact'] . "';";
	//echo $sql . "<br>";
	$result = mysqli_query($connection,$sql) or die($err[] = "Невозможно выполнить запрос на выборку товаров");
	while ($row = mysqli_fetch_array($result))  {
		$id_product_this     	   		= $row['id_product'];
		$product_name_this         		= $row['product_name'];
		$product_text_this        		= $row['product_text'];
		$price_this        				= $row['price'];
		$photo_big_this        			= $row['photo_big'];
		$photo_thumb_this        		= $row['photo_thumb'];
		
			if ($photo_thumb_this != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $photo_thumb_this))   
			{
			 $size          =  getimagesize($_SERVER['DOCUMENT_ROOT'] . $photo_thumb_this);   
			 $photo_on_page   = '<img src="' . $photo_thumb_this . '"  ' . $size[3] . '>'; 
			}
	}
	
	// выборка групп, в которых показывается  товар
	$sql_uid = "SELECT * FROM  $table_uid_groups WHERE id_product=" . $_POST['id_redact'];
	// echo $sql_uid . '<br>';
	$result_uid = mysqli_query($connection,$sql_uid) or die("Невозможно выполнить запрос на выборку из таблицы UID");
	for (
	  $i = 1,$uid_catalog_this = array(), $id_group_this = array(); 
	  $row_uid = mysqli_fetch_array($result_uid); 
	  $i++
	  ) {
		$uid_groups_this[$i]   = $row_uid['uid_groups']; 
		$id_group_this[$i]     = $row_uid['id_group']; 
	} 

		// Кол-во выбранных групп	
	$count_id_group_this = count($id_group_this);
}


	


//Запрос для вывода списка групп, доступных для выбора
$sql = 
		"
		SELECT  *
		FROM  $table_products_groups  
		ORDER BY group_name
		";

$result = mysqli_query($connection,$sql) or die($err[] = "Невозможно выполнить запрос на выборку групп");
for (
		$i = 1,
			$checked_group = ' checked="checked"',
			$checked = '',
			$to_check = 0;
		$row = mysqli_fetch_array($result);
		$i++
	)  {
	$group[$i]['id_group']          = $row['id_group'];
	$group[$i]['checked'] = '';  // начальное згачение, группа не выбрана, 
	//если форма заполнялась, показать отмеченные  группы
	if (isset($_POST['id_group']) && count($_POST['id_group']) > 0) {
		foreach($_POST['id_group'] as $key => $value) {

			if ($group[$i]['id_group'] == $value) {
				$group[$i]['checked'] = $checked_group; 
			}
		}
	}
	// форма не заполнялась, тогда отметить группы в которых показан редактируемый товар
	else {	
		for ( $num_group = 1; 	$num_group <= $count_id_group_this;  $num_group++ ) { 
			if ($group[$i]['id_group'] == $id_group_this[$num_group]) {
				$group[$i]['checked'] = $checked_group; 
			} 
		}
	}
	$group[$i]['group_name']        = $row['group_name']; 
	$group[$i]['id_group_parent']   = $row['id_group_parent']; 
}
// конец //Запрос для вывода групп

//функция формирования меню
function doMenu($list, $level){
	if ($level == 0) 
        $menu = '<ul id="menu">';

    foreach ($list as $key => $value){
        $submenu = '';
         if($value['id_group_parent'] == $level){
            $menu .= '<li><div>';
            $menu .= '<input type="checkbox" name="id_group[]" value="' . $value['id_group'] . '" ';
			$menu .=  $value['checked'] ;
			$menu .= '> ID= ' . $value['id_group'] . ', ' . $value['group_name'];
                $submenu .=  doMenu($list, $value['id_group']); // запускаем подменю для данного id_group

            if($submenu != '') $menu .= '<ul class="submenu">' . $submenu . '</ul>';

            $menu .= '</div></li>';
            }
			
        }
       if ($level == 0)  $menu .= "</ul>";
       return $menu;
}

$groups_list = doMenu($group, 0);
?>