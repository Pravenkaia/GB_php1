function item(id_of_item) {
	$.ajax({
		type: 'POST',
		url: 'engine/cart_server.php',
		data: 'id=' + id_of_item,
		success: function(){
			var divBasket = document.getElementById('basket_items');
			var  num_of_products = parseInt(divBasket.innerHTML);
			$(".basket-items").html(num_of_products + 1);
		}
	})
}
// изменение кол-ва товаров
function calc(id_of_item,price,id_order,act) {
	//id_of_item    id_товара
	//price 		цена товара
	//id_order		id заказа
	//act    действие + или - 
	var ammount = 'num' + id_of_item;
	console.log(ammount);
	var sum = 'sum' + id_of_item; 
	console.log(sum);
	console.log(act);
	
	// кол-во товара 
	var divAmmount = document.getElementById(ammount);
	var  num_of_products = parseInt(divAmmount.innerHTML);
		console.log(num_of_products);
		console.log(ammount);
	var do_operation = 1;  // разрешение на выполнение операции
	if(act == '-') {
		num_of_products--;
		if (num_of_products < 1 ) {
			do_operation = 0; // запрет на выполнение операции
		}
	}
	else {
		num_of_products++;
	}
	if (do_operation == 1)  {
		$.ajax({
			type: 'POST',
			url: '/engine/ajax_order_user.php',
			data: {
				id_product: id_of_item,
				id_order: id_order,
				operation: act
			},
			success: function(){
				//изменяем кол-во товаров на странице
				
				$(divAmmount).html(num_of_products);
			
				//изменяем сумму на странице
				var divSum = document.getElementById(sum);
				var  sum_of_products = parseInt(divSum.innerHTML);
				$(divSum).html(num_of_products*price);
			}
		})
	}
	else {
		return false;
	}
}

function delId(id_of_item,id_order,delDiv) {
	$.ajax({
		type: 'POST',
		url: '/engine/ajax_del_order_user.php',
		data: {
				id_product: id_of_item,
				id_order: id_order
		},
		success: function(){

			// удаляем строку товара
			divToDel = document.getElementById(delDiv);
			//var del = '';
			$(divToDel).remove();
		}
	})
}