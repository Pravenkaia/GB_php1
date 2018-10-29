<?
if (isset($_GET['calcAdd'])) {  // добавить товар в корзине
	addToCArt($_GET['calcAdd']);
	header ("Location: /cart/");
	exit;
}
elseif (isset($_GET['calcMinus'])) {  //убавить товар в корзине
	MinusFromCArt($_GET['calcMinus']);
	header ("Location: /cart/");
	exit;
}
elseif (isset($_GET['id']) && $_GET['id'] > 0) { // товар в корзину из каталога
	madeCookie($_GET['id']);
	header ("Location: /cart/");
	exit;
}
elseif(isset($_GET['delAll'])) {  // очистить корзину
	delAllСookie();
	header ("Location: /cart/");
	exit;
}
elseif(isset($_GET['delId'])) {  // удалить товар из корзины
	delСookie($_GET['delId']);
	header ("Location: /cart/");
	exit;
}

function goods_get($link, $id){
    $query = sprintf("SELECT * FROM products where id_product=%d",(int)$id);
    $result = mysqli_query($link, $query);

    if(!$result)
        die(mysqli_error($link));

    $good = mysqli_fetch_assoc($result);
	
    return $good;
}

//
function madeCookie($id) {
	$id = (int)$id;
	if ( isset($_COOKIE['id'][$id])) 
			$count = $_COOKIE['id'][$id] + 1;
	else 
			$count = 1;

    setcookie("id[$id]", $count, time()-60,'/');
	setcookie("id[$id]", $count, time()+160,'/');
}
//удаление одной куки
function delСookie($cooka) {
	if (isset($cooka)) {
		foreach ($cooka as $key => $value ){
			if(isset($_COOKIE['id'][$key]) && $key > 0) {
				setcookie("id[$key]", 0, time()-160,'/');
			}
			else {
				return false;
			}
		}
	}
	else {return false;}
	return true;
}
//очистка корзины
function delAllСookie() {
	if(isset($_COOKIE['id'])) {
		foreach ($_COOKIE['id'] as $key => $value ){
			if ((int)$key > 0 && (int)$value >= 0)
				setcookie("id[$key]", 0, time()-160,'/');
		}
	}
}

// добавить товар в корзине
function addToCArt($act) {
	if (isset($act)) {
		foreach ($act as $key => $value ){
			if ((int)$key > 0) {
				if(isset($_COOKIE['id'][$key])) {
					$count = $_COOKIE['id'][$key] + 1;
					//setcookie("id[$key]", $count, time()-60,'/');
					setcookie("id[$key]", $count, time()+160,'/');
				}
			}
		}
	}
}

//убавить товар в корзине
function MinusFromCArt($act) {
	if (isset($act)) {
		foreach ($act as $key => $value ){
			if ((int)$key > 0) {
				if(isset($_COOKIE['id'][$key])) {
					$count = $_COOKIE['id'][$key] - 1;
					//setcookie("id[$key]", $count, time()-60,'/');
					setcookie("id[$key]", $count, time()+160,'/');
				}
			}
		}
	}
}	
?>