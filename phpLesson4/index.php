<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Фотоальбом</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
	<header>
		<div class="header"></div>
		<nav></nav>
	</header>
	
	<main>
	
		<article>
<? 	
			include ("config/common.php");  // с адресами папок загрузки 

			include('engine/read/readdir.php');   // тение директории
			include('templates/photo/photo.php'); // фотоальбом 

?> 
	
		</article>
		<div id="time"></div>
		
<?  
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		include('engine/loads/files.php');
	else 
		include('templates/photo/photo_form.php');
?>  

   
 
	</main>  
	
	<footer>
	
	</footer>
	
	
</body>
</html>