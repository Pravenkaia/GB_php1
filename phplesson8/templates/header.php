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
				<li><a href="/">Главная</a></li>
				<li><a href="/cart">Корзина<span id="basket_items"><?=$num_of_items; ?></span></a></li>
				<li><a href="/reg">Регистрация</a></li>
				<li><a href="/users">Кабинет</a></li>
				<li><a href="/admin">Админка</a></li>
				<li><a href="/out">Выход</a></li>

			</ul>
		</nav>
	</header>