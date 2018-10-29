<?
// состояние заказа
function order_states($state) {
		
	switch ($state) {
		case 'start' :
			$state = 'В обработке';
			return $state;
		case 'paid' :
			$state = 'Оплачен';
			return $state;
		case 'finished' :
			$state = 'Выполнен';
			return $state;
		case 'cancel' :
			$state = 'Отменён';
			return $state;
		default:
			$state = 'В обработке';
			return $state;
	}	
}
?>