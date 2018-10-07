<?
$h1 = 'Фотоальбом. Превьюшки.';
$title = 'Главная. ' . $h1; 

include('config/common.php');
include('templates/header.php');

?>
	
	<main>

	
		<article class="thumbs">
<? 	

			include('engine/read/readdir.php');   // тение директории
			include('templates/photo/photo.php'); // фотоальбом 

?> 
	
		</article>

	</main>  
	
<?
include('templates/footer.php');
?>