<div class="cart">
	<form action="check.php" method="post">
		<div class="cartRow">
			<div>ID заказа: <?=$order['id_order']; ?> </div>
			<div>Дата заказа: <?= date('d.m.Y',$order['order_date']); ?></div>
			<div>
				<div id="state" class="state"><?=$state; ?></div>
				<div><input type="submit" class="btnPay" name="toPay" value="Оплатить заказ"></div>
				<div><input type="submit" class="btnCancel" name="toCancel" value="Отменить заказ" value="Отменить заказ"></div>
				<div>
					<input type="hidden" name="id_order" value="<?=$order['id_order']; ?>">
				</div>
			</div>
		</div>
	</form>
	
<? 
	for ($i = 0; $i < $count_goods; $i++) :
		
?>
		<div class="cartRow" id="cartRow<?=$i; ?>">
			<div class="cartImg">
				<a href="/?id=<?=$goods[$i]['id_product'];?>"><?=$goods[$i]['product_name'];?></a>
				<br>
				<a href="/?id=<?=$goods[$i]['id_product'];?>">
					<img src="<? if ($goods[$i]['photo_thumb'] != '') echo $goods[$i]['photo_thumb']; else  echo NO_PHOTO; ?>">
				</a>
			</div>
			<div class="calc" id="price<?=$goods[$i]['id_product'];?>"><?=$goods[$i]['price'];?> р.</div>
			<div class="calc">
				<button onclick="calc(<?=$goods[$i]['id_product'];?>, <?=$goods[$i]['price']; ?>, <?=$order['id_order']; ?>,'-');">-</button>
			</div>
			<div class="calc" id="num<?=$goods[$i]['id_product'];?>"><?=$goods[$i]['ammount']; ?></div>
			<div class="calc">
				<button  onclick="calc(<?=$goods[$i]['id_product'];?>, <?=$goods[$i]['price']; ?>, <?=$order['id_order']; ?>,'+')">+</button>
			</div>
			<div class="calc" id="sum<?=$goods[$i]['id_product'];?>"><?=$goods[$i]['ammount'] * $goods[$i]['price']; ?> р.</div>
			<div class="calc"><button class="btnDel" onclick="delId(<?=$goods[$i]['id_product'];?>,<?=$order['id_order']; ?>,'cartRow<?=$i;?>')" title="Удалить">x</button></div>
		</div>

<? endfor; ?>	

</div>

