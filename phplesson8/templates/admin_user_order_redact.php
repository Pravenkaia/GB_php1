<div class="cart">
	<form action="#" method="post">
		<div class="cartRow">
			<div>ID заказа: <?=$order['id_order']; ?> </div>
			<div>Дата заказа: <?= date('d.m.Y',$order['order_date']); ?></div>
			<div>Сумма заказа: <?= $order['sum']; ?></div>
			<div>
				<div class="state"><?=$state; ?></div>
				<div><input type="submit" class="btnPay" name="toPay" value="Оплачен"></div>
				<div><input type="submit" class="btnCancel" name="toCancel" value="Отменён"></div>
				<div><input type="submit" class="btnFinish" name="toFinish" value="Выполнен"></div>
				<div>
					<input type="hidden" name="id_order" value="<?=$order['id_order']; ?>">
				</div>
			</div>
			<div>
				<div>Телефон: <?=$order['phone_number']; ?></div>
				<div><?=$order['comm']; ?></div>
			</div>
			
		</div>
	</form>
	
	<div class="cartRow">
		<div>ID юзера: <?=$user['id_author'];?></div>
		<div>login: <?=$user['author_login'];?></div>
		<div><?=$user['author_family']?>  <?=$user['author_name'];?></div>
		<div><?=$user['author_email'];?></div>
		<div><?=date('d.m.Y',$user['date_reg']);?></div>
	</div>
	
<? 
	for ($i = 0; $i < $count_products; $i++) :
		
?>
		<div class="cartRow">
			<div class="cartImg">
				<?=$products[$i]['product_name'];?>
				<br>
				<img src="<? if ($products[$i]['photo_thumb'] != '') echo $products[$i]['photo_thumb']; else  echo NO_PHOTO; ?>">
			</div>
			<div class="calc" id="price<?=$products[$i]['id_product'];?>"><?=$products[$i]['price'];?> р.</div>

			<div class="calc" id="num<?=$products[$i]['id_product'];?>"><?=$products[$i]['ammount']; ?></div>

			<div class="calc" id="sum<?=$products[$i]['id_product'];?>"><?=$products[$i]['ammount'] * $products[$i]['price']; ?> р.</div>

		</div>

<? endfor; ?>	

</div>

