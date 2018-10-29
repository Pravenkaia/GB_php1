<h3>Товаров в корзине: <?=$count_arr_cart; ?></h3>

<form action="doing_order.php" method="POST">
    <div class="reg">
	
		<div><label for="phone"><span class=bold>*</span>Телефон (только цифрами, без пробелов и скобок)</label></div>
		<div><input id="phone" type="text" name="phone_number" value="<? if(isset($_POST['phone_number'])) echo str_replace('(','',str_replace(')','',str_replace(' ','',$_POST['phone_number'])));?>" required></div>
	
		<div><label for="comm">Ваши дополнения </label></div>
		<div><textarea id="comm" name="comm" rows="3"><? if(isset($_POST['comm'])) echo htmlspecialchars(strip_tags(trim($_POST['comm'])));?></textarea></div>
	
<? for ($i = 0; $i < $count_arr_cart; $i++) : ?>

		<div>
			<input type="hidden" name="id_product[]" value="<?=$arr_cart[$i]['id'];?>">
			<input type="hidden" name="ammount[]" 	 value="<?=$arr_cart[$i]['ammount'];?>">
		</div>
	
<? endfor;?>

		<div>
			<div><input type="submit" name="to_order" value="Оформить заказ"></div>
			<div><input type="submit" name="to_del_order" value="Отменить заказ"></div>
		</div>
	</div>
</form>
