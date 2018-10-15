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

include('../config/common.php');
if ( isset($_COOKIE['id'])) {
	$cartForm = '';
	$sum = 0;
	foreach ($_COOKIE['id'] as $key => $value ){
		
		$goods = (goods_get($connection,$key));
		if (is_array($goods)) {
			$cart = madeForm($key,$value, $goods['product_name'], $goods['photo_thumb'], $goods['price']);
			$cartForm .= $cart[0];
			$sum += $cart[1];
		}
	}
	if ($cartForm != '') {
		$cartForm = '<form action="/cart/">
						<div class="cart">' . $cartForm . '</div>
						<div>Итого к оплате: ' . $sum . ' р.</div>
						<div>
							<input type="submit" name="delAll" value="Очистить корзину">
						</div>
				 </form>';
	}
}


function madeForm(
			$id,
			$count, //кол-во товара (в корзине имеется в виду)
			$product_name, $photo_thumb, $price ) {
		$cartForm = '<div class="cartRow">';
		$cartForm .= '<div class="cartImg"><a href="/?id=' . $id . '">' . $product_name . '</a><br>';
		$cartForm .= '<a href="/?id=' . $id . '">';
		if ($photo_thumb != '') 
			$cartForm .= '<img src="' . $photo_thumb . '">';
		else 
			$cartForm .= '<img src="/img/shablon-images/no_photo.png">';
		$cartForm .=  '</a></div>';
		$cartForm .= '<div class="calc">' . $price  . ' р.</div>';
		if ($count <=0) {
			$disabled = '  disabled="disabled" ';
		}
		else {
			$disabled = '';
		}
		$cartForm .= '<div class="calc"><input type="submit"' . $disabled . ' name="calcMinus[' . $id . ']" value="-"></div>';
		$cartForm .= '<div class="calc">' . $count . '</div>';
		$cartForm .= '<div class="calc"><input type="submit" name="calcAdd[' . $id . ']" value="+"></div>';
		$cartForm .= '<div class="calc">' . $count * $price . ' р.</div>';
		$cartForm .= '<div class="calc"><input class="btnDel" type="submit" name="delId[' . $id . ']" value="x" title="Удалить"></div>';
		$cartForm .= '</div>';

		//$sum = $count * $price;
		$cart[] = $cartForm;
		$cart[] = $count * $price;
		return $cart;
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