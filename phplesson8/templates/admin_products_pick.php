
	
	<form action="mod_products_show.php" method="post">
	  <div><input type="SUBMIT" value="Выбрать товар для редактирования" ></div>
		<div class="productsAdmin">
			
		<? for ($i = 0; $i < $countGoods; $i++) : ?>
			<div>
				<div>
					<img src="<?=$photo_thumb_list[$i]; ?>">
				</div>
				<div>
					<input id="<?=$id_product_list[$i]; ?>" type="radio" name="id_redact" value="<?=$id_product_list[$i]; ?>"> ID=<?=$id_product_list[$i]; ?>
				</div>
				<div>
					<label for="<?=$id_product_list[$i]; ?>"><?=$product_name_list[$i];?></label>
				</div>
			</div>
						  

		<? endfor; ?>
		</div>
	  <div><input type="SUBMIT" value="Выбрать товар для редактирования" ></div>
	</form>