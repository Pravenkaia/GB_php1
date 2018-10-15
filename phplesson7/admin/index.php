<?
$h1 = 'Админка';
$title = $h1; 

include('../config/common.php');
include('../templates/header.php');

?>
<main>

<?
	$menu_block =  "<h3 align=center>Админка</h3>";

		$menu_block .= "
		<table align=center width=450>
		";

		$menu_block .= "
			
					<tr bgcolor=#eeeeee>
					<td><span class=bold>Товары</span></td>
					<td><a href='products/mod_products_show.php' title='Добавить'><img src='"  . $src_plus . "' "  . $size_plus[3] . " border=0 alt='Добавить' /></a></td>
					<td><a href='products/mod_products_pick.php' title='Редактировать'><img src='"  . $src_edit . "' " . $size_edit[3] . " border=0 alt='Редактировать' /></a></td>
					<td><a href='products/del_products_pick.php' title='Удалить'><img src='" . $src_drop . "' " . $size_drop[3] . " border=0 alt='Удалить' /></a></td>
					</tr>
					
					";
					
		echo $menu_block;
?>
<main>
<?		
include('../templates/footer.php');		
?>			