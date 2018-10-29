<?
//проверка администратора
include('../../engine/session_check_admin.php');
//
include('../../config/common.php');
include('../../engine/dll_functions/doMenuGroupsAdmin.php');
include('../../engine/admin/mod_products_show.php');


$h1 = $mode_or_add;
$title = $h1;
include('../../templates/header.php');

?>


<main class="twoForm"> 

	
	<div class="divFormProd">
		<form id="formProd" method=POST ACTION="mod_products_check.php" ENCTYPE="multipart/form-data">
<? 			if (isset($_POST['id_redact']) && $_POST['id_redact'] > 0) { echo '<input type=hidden name=id_redact value="' . $_POST['id_redact'] . '" >';}  ?>
			<div><h3 align=center><? echo $mode_or_add; ?></h3></div>
			<div><input type=SUBMIT value="Сохранить  описание товара" ></div>
  
			<div>ID <?=$id_product_this; ?></div>
		
			<div class="field"><font class=bold>*</font> Название товара: </div>
			<div><input  type=TEXT name=product_name  size=30 value='<? if (isset($_POST['product_name']) ) echo $_POST['product_name']; else echo $product_name_this; ?>' ></div>
		
			<div><font class=bold>* Цена:</font></div>
			<div><input  type=TEXT name=price  size=30 value='<? if (isset($_POST['price'])) echo $_POST['price']; else echo $price_this; ?>' ></div>
		
			<div>* ВЫБРАТЬ группы, в которых показывать товар</div>
			<div class="groups_list">
				<ul id="menu">
					<?=$groups_list;?>
				</ul>
				</div>
				
			<div><span class=bold>Описание товара:</span></div>
			<div><TEXTAREA   rows=7  id="product_text" name="product_text"><? if (isset($_POST['product_text'])) echo $_POST['product_text']; else echo $product_text_this; ?></textarea></div>

			<div>
			<FIELDSET>
			<LEGEND>Файл ИЗОБРАЖЕНИЯ</LEGEND>
			<font class=bold color=red>*</font> Фото:  (не более 1000 px)<br>
			<input  type="file" name="photo" accept="image/jpeg,image/png,image/gif">
<? 
			if ($photo_big_this != '' || $photo_thumb_this != '') 
				{
				echo '<input type=hidden name="photo_big" value="'   . $photo_big_this . '">';
				echo '<input type=hidden name="photo_thumb" value="' . $photo_thumb_this . '">';
				echo "<br><br>" . $photo_on_page;
				}
?>
			</FIELDSET>
			
			</div>
			
			<div><input type=SUBMIT value="Сохранить описание товара" ></div> 
			
			
			
			
		</form>

	</div>
   

</main>
<?
include('../../templates/footer.php');
?>


