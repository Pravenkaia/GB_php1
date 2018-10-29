<h3><?=$author['author_name'];?></h3>

<? if (!empty($author_orders)) : ?>
<table class="orders" cellpadding="10" cellspacing="5">
	<tr>
		<td>ID заказа</td>
		<td>Сумма</td>
		<td>Дата</td>
		<td>Состояние</td>
	</tr>
<?
	foreach ($author_orders as $author_order) :

		$state = order_states($author_order['order_state']);
		
?>
		<tr>
			<td><a href="?id_order=<?= $author_order['id_order']; ?>"><?=$author_order['id_order']; ?> >>>>>></a></td>
			<td><?= $author_order['sum']; ?> руб.</td>
			<td><?= date('d.m.Y',$author_order['order_date']); ?></td>
			<td><?=$state; ?></td>
		</tr>
<?		
	endforeach;	
?>
</table>

<?endif; ?>