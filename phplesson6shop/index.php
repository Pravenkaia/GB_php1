<?
$h1 = 'Каталог товаров';
$title = 'Главная. ' . $h1; 

include('config/common.php');
include('templates/header.php');

?>
	
	<main <? if (isset($_GET['id']) && $_GET['id'] > 0) echo 'class="ful"'; ?>>


<? 	

			if (isset($_GET['id']) && $_GET['id'] > 0) {
				include('engine/_products_ful.php');
			}
			else {
				include('engine/_products.php');
			}

?> 
	

	</main>  
	
<?
include('templates/footer.php');
?>