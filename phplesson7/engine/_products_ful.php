<?
include('config/common.php');
if (isset($_GET['id']) && $_GET['id'] > 0) : 
	$sql = "SELECT * FROM $table_products WHERE id_product='" . $_GET['id'] . "' ORDER BY product_name;";
	//echo $sql . "<br>";
	$result = mysqli_query($connection,$sql) or die($err[] = "Невозможно выполнить запрос на выборку товаров");
	$divs_product = '';
	for ($i = 1; $row = mysqli_fetch_array($result);  $i++)  {
		$id_product_list[$i]     	   		= $row['id_product'];
		$product_name_list[$i]         		= $row['product_name'];
		$product_text_list[$i]        		= $row['product_text'];
		$photo_big_list[$i]        			= $row['photo_big']; 
		
		if ($photo_big_list[$i] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $photo_big_list[$i]))   {
			$size[$i]          =  getimagesize($_SERVER['DOCUMENT_ROOT'] . $photo_big_list[$i]);   
			$photo_big_list[$i]   = '<div><img src="' . $photo_big_list[$i] . '" ' . $size[$i] . '></div>'; 
		}
		else {
			$photo_big_list[$i] = '<div><img src="/img/shablon-images/no_photo.png"></div>'; 
		}
		$divs_product   .= $photo_big_list[$i] .
							'<div>' .
								 '<div> ID=' . $id_product_list[$i] . '</div>' .
								 '<div>' . $product_name_list[$i] . '</div>' . 
								 '<div><a class="btnBuy" href="/cart?id=' . $id_product_list[$i] . '">Купить</a></div>' .
								 '<div>' . $product_text_list[$i] .'</div>' .
							'</div>';
						  
		 
	}
	if ($divs_product != '') {
		 $divs_product = '<div class="products">' . $divs_product . '</div>';
	}

	echo $divs_product;
endif;