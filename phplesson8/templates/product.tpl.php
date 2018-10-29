	<div class="productsAdmin">
<?	
    foreach ($products as $product) :
?>
		<div class="product">
			<div><a href="?id=<?= $product['id_product']; ?>"><img src="<? $img = imgProduct($product['photo_thumb']); echo $img[0];?>" <?=$img[1];?> alt="<?=$product['product_name'];?>"></a></div>
			<div> ID=<?= $product['id_product']; ?></div>
			<div><a href="/?id=<?= $product['id_product']; ?>"><?= $product['product_name']; ?></a></div>
			<div><a class="btnBuy" href="/cart?id=<?= $product['id_product']; ?>">Купить</a></div>
		</div>
<?		
	endforeach;	
?>
	</div>

