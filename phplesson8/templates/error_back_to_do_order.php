<form action="do_order.php" method="post">
	<input type="hidden" name="comm" value="<? if(isset($_POST['comm'])) echo htmlspecialchars(strip_tags(trim($_POST['comm'])));?>">
	<input type="hidden" name="phone_number" value="<? if(isset($_POST['phone_number'])) echo str_replace('(','',str_replace(')','',str_replace(' ','',$_POST['phone_number'])));?>">
	<input type="submit" value="Обратно к вводу данных">
</form>