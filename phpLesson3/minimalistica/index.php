<?
//для тега <div class="post">
// h1, title
$title = 'minimalistica';
// h2 заголовок для div details
$h2Details = '<a href="#">Nunc commodo euismod massa quis vestibulum</a>';
// p  для div details
$pDetails = 'posted 3 hours ago in <a href="#">general</a>';
// div с кклассом Body
$divBody = 'Nunc eget nunc libero. Nunc commodo euismod massa quis vestibulum. Proin mi nibh, dignissim a pellentesque at, ultricies sit amet sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel lorem eu libero laoreet facilisis. Aenean placerat, ligula quis placerat iaculis, mi magna luctus nibh, adipiscing pretium erat neque vitae augue. Quisque consectetur odio ut sem semper commodo. Maecenas iaculis leo a ligula euismod condimentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut enim risus, rhoncus sit amet ultricies vel, aliquet ut dolor. Duis iaculis urna vel massa ultricies suscipit. Phasellus diam sapien, fermentum a eleifend non, luctus non augue. Quisque scelerisque purus quis eros sollicitudin gravida. Aliquam erat volutpat. Donec a sem consequat tortor posuere dignissim sit amet at ipsum.';
// div с классом x
$x = '';
//1-я колонка
//h3
$h3Col1 = '<a href="#">Ut enim risus rhoncus</a>';
$pCol1 = 'Quisque consectetur odio ut sem semper commodo. Maecenas iaculis leo a ligula euismod condimentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut enim risus, rhoncus sit amet ultricies vel, aliquet ut dolor. Duis iaculis urna vel massa ultricies suscipit. Phasellus diam sapien, fermentum a eleifend non, luctus non augue. Quisque scelerisque purus quis eros sollicitudin gravida. Aliquam erat volutpat. Donec a sem consequat tortor posuere dignissim sit amet at.';
$a1 = '<a href="#">read more</a>';
//2-я колонка
$h3Col2 = '<a href="#">Maecenas iaculis leo</a>';
$pCol2 = 'Quisque consectetur odio ut sem semper commodo. Maecenas iaculis leo a ligula euismod condimentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut enim risus, rhoncus sit amet ultricies vel, aliquet ut dolor. Duis iaculis urna vel massa ultricies suscipit. Phasellus diam sapien, fermentum a eleifend non, luctus non augue. Quisque scelerisque purus quis eros sollicitudin gravida. Aliquam erat volutpat. Donec a sem consequat tortor posuere dignissim sit amet at.';
$a2 = '<a href="#">read more</a>';
//3-я колонка
//h3
$h3Col3 = '<a href="#">Quisque consectetur odio</a>';
$pCol3 = 'Quisque consectetur odio ut sem semper commodo. Maecenas iaculis leo a ligula euismod condimentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut enim risus, rhoncus sit amet ultricies vel, aliquet ut dolor. Duis iaculis urna vel massa ultricies suscipit. Phasellus diam sapien, fermentum a eleifend non, luctus non augue. Quisque scelerisque purus quis eros sollicitudin gravida. Aliquam erat volutpat. Donec a sem consequat tortor posuere dignissim sit amet at.';
$a3 = '<a href="#">read more</a>';

//навигация
$list1 = '<a href="#">home</a>';
$list2 = '<a href="#">archive</a>';
$list3 = '<a href="#">contact</a>';

$list = Array
		(
			Array (
            'id' => 1,
            'name' => 'Home',
            'href' => '#',
            'title' => 'Главная',
			'parents' => '0'
			),
			
			Array (
            'id' => 2,
            'name' => 'archive',
            'href' => '#',
            'title' => 'archive',
			'parents' => '0'
			),

			Array (
            'id' => 3,
            'name' => 'contact',
            'href' => '#',
            'title' => 'contact',
			'parents' => '0'
			),
			Array (
            'id' => 4,
            'name' => 'about',
            'href' => '#',
            'title' => 'about',
            'parents' => 3
			),
			Array (
            'id' => 5,
            'name' => 'shops',
            'href' => '#',
            'title' => 'shops',
            'parents' => 3
			)
);

function doMenu($list, $level=0){
	if ($level == 0) 
        $menu = '<ul id="menu">';

    foreach ($list as $key => $value){
        $submenu = '';
		
         if($value['parents'] == $level){
            $menu .= '<li>';
            $menu .= '<a href="' . $value['href'] . '" title="' . $value['title'] . '">' . $value['name'] . '</a>';
                $submenu .=  doMenu($list, $value['id']); // запускаем подменю для данного id

            if($submenu != '') $menu .= '<ul class="submenu">' . $submenu . '</ul>';

            $menu .= '</li>';
            }
			
        }
       if ($level == 0)  $menu .= "</ul>";
        return $menu;
    }






// footer
$copyRight = 'Copyright &copy; <em>' . $title . '</em> &middot; ';
$design = 'Design: Luka Cvrk, <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a>';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="author" content="Luka Cvrk (www.solucija.com)" />
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<title><?=$title;?></title>
</head>
<body>
	<div id="content">
		<h1><?=$title;?></h1>
		
		<? echo doMenu($list, 0); ?>
	
		<div class="post">
			<div class="details">
				<h2><?=$h2Details;?></h2>
				<p class="info"><?=$pDetails;?></p>
			
			</div>
			<div class="body"><?=$divBody;?></div>
			<div class="x"><?=$x;?></div>
		</div>
		
		<div class="col">
			<h3><?=$h3Col1;?></h3>
			<p><?=$pCol1;?></p>
			<p>&not; <?=$a1;?></p>
		</div>
		<div class="col">
			<h3><?=$h3Col2;?></h3>
			<p><?=$pCol2;?></p>
			<p>&not; <?=$a2;?></p>
		</div>
		<div class="col last">
			<h3><?=$h3Col3;?></h3>
			<p><?=$pCol3;?></p>
			<p>&not; <?=$a3;?></p>
		</div>
		
		<div id="footer">
			<p><?=$copyRight . $design;?></p>
		</div>	
	</div>
</body>
</html>