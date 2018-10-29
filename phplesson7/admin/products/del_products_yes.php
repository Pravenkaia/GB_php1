<?
if($_SERVER['REQUEST_METHOD'] != 'POST') :  // if: 1 SERVER['REQUEST_METHOD'] != 'POST'
	header ("Location: /");
	exit;
elseif (!isset($_POST['id_del'])) : 
		header ("Location: del_products_pick.php?comm=1");
		exit;
else:
	
	include('../../config/common.php');
	
	$divs_product = ''; // набор товаров для удаления
	if (isset($_POST['id_del'])) :
	
		$what_product = ''; $k = 1;
		foreach ($_REQUEST['id_del'] as $id) {
			if ($id > 0) {
				// Формирование условия запроса
				if     ($what_product === '') {$what_product .= " id_product='"    . $id . "'";}
				else                          {$what_product .= " OR id_product='" . $id . "'";}
			}
		}
		if ($what_product != '') {
			$what_product = ' WHERE (' . $what_product . ') ';
		}
		else {
			$h1= 'Не выбрана ни одна запись!<br>';
		}

		$sql = "SELECT * FROM $table_products $what_product ORDER BY product_name;";
		//echo $sql . "<br>";
		$result = mysqli_query($connection,$sql) or die($err[] = "Невозможно выполнить запрос на выборку товаров");
		for ($i = 1; $row = mysqli_fetch_array($result);  $i++)  {
			$id_product_list[$i]     	   		= $row['id_product'];
			$product_name_list[$i]         		= $row['product_name'];
			$product_text_list[$i]        		= $row['product_text'];
			$photo_big_list[$i]        			= $row['photo_big'];
			$photo_thumb_list[$i]        		= $row['photo_thumb'];
		
			if ($photo_thumb_list[$i] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $photo_thumb_list[$i]))   {
				$size[$i]          =  getimagesize($_SERVER['DOCUMENT_ROOT'] . $photo_thumb_list[$i]);   
				$photo_thumb_list[$i]   = '<div><img src="' . $photo_thumb_list[$i] . '" ' . $size[$i] . '></div>'; 
			}
			else {
				$photo_thumb_list[$i] = '<div><img src="/img/shablon-images/no_photo.png"></div>'; 
			}
			$divs_product   .= '<div>' . 
								$photo_thumb_list[$i] . 
								'<div><input id="' . $id_product_list[$i] .  '" type="hidden" name="id_del[]" value="' . $id_product_list[$i] . '"> ID=' . $id_product_list[$i] . '</div>
								 <div><label for="' . $id_product_list[$i] . '">' . $product_name_list[$i] . '</label></div>' . 
							'</div>';
						  
		 
		}
		if ($divs_product != '') {
			$divs_product = '<div class="productsAdmin">' . $divs_product . '</div>';
		};
	else:
		$h1    .= 'Не выбрана ни одна запись!';
	endif;
	$title = $h1;
	$h1    .= 'Подтверждение удаления';
	
	include('../../templates/header.php');	
	if ($divs_product != '') :
?>
		<main>
			<form action="del_products_do.php" method="post">
				<div><input type=SUBMIT value="Удалить" ></div>
				<div><input type=SUBMIT name="no" value="НЕТ!" ></div>
				<?=$divs_product; ?>
				<div><input type=SUBMIT value="Удалить" ></div>
				<div><input type=SUBMIT name="no" value="НЕТ!" ></div>
			</form>
		</main>

<?
	endif;
	include('../../templates/footer.php');	

endif;
?>