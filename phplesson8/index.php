<?
$h1 = 'Каталог товаров';
$title = 'Главная. ' . $h1; 

include('config/common.php');
include('engine/products_db.php');
include('engine/dll_functions/imgProduct.php');
include('templates/header.php');


?>
	
	<main<? if (isset($_GET['id']) && (int)$_GET['id'] > 0) echo ' class="ful"'; ?>>
	

<? 	

			if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
				$product = [];
				$product = products_get_id($connection, (int)$_GET['id']);
				if($product)
					include('templates/product_id.tpl.php');
			}
			else {
				$products = [];
				$products = products_get($connection);
				if($products)
					include('templates/product.tpl.php');
			}

?> 
	

	</main>  
	
<?
include('templates/footer.php');
?>