
<? if (!empty($orders)) : ?>
<form action="mod_order.php"  method="post">
  <table class="orders" cellpadding="10" cellspacing="5">
	<tr>
		<td>ID заказа</td>
		<td>ID, login юзера</td>
		<td>ФИО</td>
		<td>Сумма</td>
		<td>Дата</td>
		<td>Состояние</td>
	</tr>
<?
	foreach ($orders as $order) :
		
		$state = '';
		if ($order['order_state'] == 'start')
			$state = 'В обработке';
		elseif($order['order_state'] == 'paid') 
			$state = 'Оплачен'; 
		elseif($order['order_state'] == 'finished') 
			$state = 'Выполнен';
		
?>
		<tr>
			<td><input type="submit" name="id_order" value="<?= $order['id_order']; ?>"></td>
			<td><?=$order['id_author']; ?>, <?=$order['author_login']; ?></td>
			<td><?= $order['author_family']; ?> <?=$order['author_name']; ?></td>
			<td><?= $order['sum']; ?> руб.</td>
			<td><?= date('d.m.Y',$order['order_date']); ?></td>
			<td><?=$state; ?></td>
		</tr>
<?		
	endforeach;	
?>
  </table>
</form>

<?endif; ?>