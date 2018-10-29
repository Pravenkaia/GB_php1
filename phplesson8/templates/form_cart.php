<form action="/cart/">
	<div class="cart">
	
<? for ($i = 0; $i < $count_goods; $i++) :?>
		<div class="cartRow">
			<div class="cartImg">
				<a href="/?id=<?=$goods[$i]['id'];?>"><?=$goods[$i]['product_name'];?></a>
				<br>
				<a href="/?id=<?=$goods[$i]['id'];?>">
					<img src="<? if ($goods[$i]['photo_thumb'] != '') echo $goods[$i]['photo_thumb']; else  echo NO_PHOTO; ?>">
				</a>
			</div>
			<div class="calc"><?=$goods[$i]['price'];?> р.</div>
			<div class="calc">
				<input type="submit" <? if ($goods[$i]['ammount'] < 1) echo '  disabled="disabled" ';?> name="calcMinus[<?=$goods[$i]['id'];?>]" value="-">
			</div>
			<div class="calc"><?=$goods[$i]['ammount']; ?></div>
			<div class="calc">
				<input type="submit" name="calcAdd[<?=$goods[$i]['id'];?>]" value="+">
			</div>
			<div class="calc"><?=$goods[$i]['ammount'] * $goods[$i]['price']; ?> р.</div>
			<div class="calc"><input class="btnDel" type="submit" name="delId[<?=$goods[$i]['id'];?>]" value="x" title="Удалить"></div>
		</div>

<? endfor; ?>	

	</div>
	<div>Итого к оплате:<?=$sum;?> р.</div>
	<div>
	<input type="submit" name="delAll" value="Очистить корзину">
	</div>
</form>
				 
				 
