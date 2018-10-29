<div align=center>
			<form method=POST ACTION="mod_products_show.php" ENCTYPE="multipart/form-data">
<?
				if (isset($_POST['id_group']) && count($_POST['id_group']) > 0) {
					foreach($_POST['id_group'] as $key => $value) {
						echo '<input type=hidden name="id_group[]" value="' . $value . '" >';
					}
				}
?>			
				<input type=hidden name=full_form  value='1' >
				<input type=hidden name=id_redact    	value='<? if (isset($_POST['id_redact']) && $_POST['id_redact'] > 0) 		echo $_POST['id_redact']; ?>' >

				<input type=hidden name=price    		value='<? if (isset($_POST['price'])) 		echo (int)$_POST['price']; ?>' >

				<input type=hidden name=product_name    value='<? if (isset($_POST['product_name']))  echo htmlspecialchars(strip_tags(str_replace("'","&#39;",trim($_POST['product_name']))));  ?>' >
				<input type=hidden name=product_text    value='<? if (isset($_POST['product_text']))  echo htmlspecialchars(strip_tags(str_replace("'","&#39;",trim($_POST['product_text']))));  ?>' >

				<input  type=submit value="   Вернуться к вводу информации   ">
			</form>
</div>