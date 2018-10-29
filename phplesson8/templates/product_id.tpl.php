
<div class="product_full">
		<div class="product">
			<div>
				<a href="?id=<?= $product['id_product']; ?>">
					<img src="<? $img = imgProduct($product['photo_big']); echo $img[0];?>" <?=$img[1];?> alt="<?=$product['product_name'];?>">
				</a>
			</div>
		</div>
		<div class="product flexStart">
			<div> ID=<?= $product['id_product']; ?></div>
			<div><a href="/?id=<?= $product['id_product']; ?>"><?= $product['product_name']; ?></a></div>
			<div><?= $product['product_text']; ?></div>
			<div><a class="btnBuy" href="/cart?id=<?= $product['id_product']; ?>">Купить</a></div>
		</div>

</div>



