<?
include('../../config/common.php');

$sql = "SELECT * FROM $table_products ORDER BY product_name;";
	//echo $sql . "<br>";
	$result = mysqli_query($connection,$sql) or die($err[] = "Невозможно выполнить запрос на выборку товаров");
	$divs_product = '';
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
								'<div><input id="' . $id_product_list[$i] .  '" type="radio" name="id_redact" value="' . $id_product_list[$i] . '"> ID=' . $id_product_list[$i] . '</div>
								 <div><label for="' . $id_product_list[$i] . '">' . $product_name_list[$i] . '</label></div>' . 
							'</div>';
						  
		 
	}
	if ($divs_product != '') {
		 $divs_product = '<div class="productsAdmin">' . $divs_product . '</div>';
	}

$h1    = 'Выбрать запись для редактирования';
$title = $h1;	
include('../../templates/header.php');	

?>
<main>
	<form action="mod_products_show.php" method="post">
		<div><input type=SUBMIT value="Выбрать товар для редактирования" ></div>
		<?=$divs_product; ?>
		<div><input type=SUBMIT value="Выбрать товар для редактирования" ></div>
	</form>
</main>

<?
include('../../templates/footer.php');	
?>