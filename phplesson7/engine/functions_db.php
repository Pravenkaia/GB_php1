<?
// проверка наличия логина на дублирование
function authors_get($link, $log){
		$log = htmlspecialchars(strip_tags(trim($log)));
		$query = sprintf("SELECT author_login FROM authors WHERE author_login='%s'",$log);
		$result = mysqli_query($link, $query);

		if(!$result) {
			die(mysqli_error($link));
			return false;
		}
		$count = mysqli_num_rows($result);
		if ($count > 0) 
			return $count;
		else
			return false;
}

// проверка наличия в базе по логину и паролю
function authors_get_id($link, $log, $pas){
		$log = htmlspecialchars(strip_tags(trim($log)));
		$pas = trim($pas); 

		$query = sprintf("SELECT id_author, author_pass FROM authors WHERE author_login='%s'",$log);
		//echo $query . '<br>';
		$result = mysqli_query($link, $query);

		if(!$result) {
			die(mysqli_error($link));
			return false;
		}

		$id = 0;
		while ($row = mysqli_fetch_array($result)) {
			$id = $row['id_author']; 
			$password = $row['author_pass'];
		}
		
		if($id > 0) {
			if ($pass  = password_verify($pas, $password) ) 
			//	if (md5($pass) == $password)
				return $id;
			else 
				return false;
		}
		else {
			return false;
		}

}

function authors_get_id_arr($link, $id){

		$query = sprintf("SELECT * FROM authors WHERE id_author='%d'",(int)$id);
		$result = mysqli_query($link, $query);

		if(!$result) {
			die(mysqli_error($link));
			return false;
		}

		if($row = mysqli_fetch_array($result)) 
			return $row;
		else 
			return false;
}

	
// добавление автора в БД	
function authors_insert($link, 
							$rights,
							$author_name,
							$author_family,
							$author_login,
							$author_pass,
							$author_email,
							$date_reg){
								
								
		$author_name   = htmlspecialchars(strip_tags(trim($author_name)));
		$author_family = htmlspecialchars(strip_tags(trim($author_family)));
		$author_login  = htmlspecialchars(strip_tags(trim($author_login)));
		
		$author_pass   = htmlspecialchars(strip_tags(trim($author_pass))); 
		$author_pass   = password_hash($author_pass,PASSWORD_DEFAULT);
		//$author_pass = md5($author_pass);
		$author_email  = strip_tags(trim($author_email));
	/*
	echo '$author_name=' . $author_name . '<br>';
	echo '$author_family=' . 	$author_family . '<br>';
	echo '$author_login=' . 	$author_login . '<br>';
	echo '$author_pass=' . 	$author_pass . '<br>';
	echo '$author_email=' . 	$author_email . '<br>';
	*/
		if ($author_name != '' && $author_family != '' && $author_login != '' && $author_pass != '' && $author_email != '') :

			// строка запроса Ввод данных автора в базу данных
			$sql = sprintf("INSERT INTO authors (
							rights,
							author_name,
							author_family,
							author_login,
							author_pass,
							author_email,
							date_reg
							) VALUES (
							'%d','%s','%s','%s','%s','%s','%d');",
							(int)$rights,
							$author_name,
							$author_family,
							$author_login,
							$author_pass,
							$author_email,
							(int)$date_reg);
			//echo '$sql:' . $sql . "<br>";  
		
			$result = @mysqli_query($link,$sql); // or die($mes[] = "Невозможно выполнить запрос на добавление");

			if(!$result) {
				die(mysqli_error($link));
				return false;
			}
			else {
				return true;
			}
		else:
			return false;
		endif;
}
?>