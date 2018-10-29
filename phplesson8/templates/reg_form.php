<form method="post" ACTION="check_registration.php" ENCTYPE="multipart/form-data">


  <div class="reg">

	<div><label for="authorName"><span class="bold">*</span> Имя автора: </label></div>
	<div><input id="authorName" type="text" name="author_name"   value="<? if(isset($_POST['author_name'])) echo $_POST['author_name']; ?>" maxlength="50" required></div>
	
	<div><label for="authorFam"><span class=bold>*</span> Фамилия автора: </label></div>
	<div><input  id="authorFam" type="text" name="author_family" value="<? if(isset($_POST['author_family'])) echo $_POST['author_family']; ?>" maxlength="50" required></div>

	<div><label for="email"><span class=bold>*</span>email: </label></div>
	<div><input id="email" type="email" name="author_email"  maxlength="50" value="<? if(isset($_POST['author_email'])) echo $_POST['author_email']; ?>" required></div>

	<div><label for="log"><span class=bold>*</span>Л о г и н</label></div>
	<div><input id="log" type="text" name="author_login" value="<? if(isset($_POST['author_login'])) echo $_POST['author_login']; ?>" required></div>
	
	<div><label for="pas"><span class=bold>*</span>П а р о л ь</label></div>
	<div><input id="pas" type="password" name="author_pass" value="" required></div>


	<div><input type=SUBMIT value="Сохранить"></div>


  </div>

</form>