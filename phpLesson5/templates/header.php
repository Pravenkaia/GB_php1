<?
if (!isset($title)) $title = 'Мой альбом';
if (!isset($h1))    $h1 = 'Мой альбом';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$title; ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
	<header>
		<div class="header">
			<h1><?=$h1; ?></h1>
		</div>
		
		<nav>
			<ul>
				<li><a href="/">Главная. Превьюшки</a></li>
				<li><a href="<?=$pathAdminAlbum; ?>">Добавить фото</a></li>
				<li><a href="<?=$pathAlbum; ?>">Большие фото</a></li>
			</ul>
		</nav>
	</header>