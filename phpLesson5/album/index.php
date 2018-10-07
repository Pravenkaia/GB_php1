<?
$h1 = 'Фотоальбом. Большие фото.';
$title = $h1; 

include('../config/common.php');
include('../templates/header.php');

?>
	

	<main>
	
		<article class="photo_big">
<? 	


			include('../templates/photo/photo_big.php'); // фотоальбом 

?> 
	
		</article>

	</main>
	
<?
include('../templates/footer.php');
?>