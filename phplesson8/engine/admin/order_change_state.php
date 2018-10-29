<? 
//проверка админа
include('../../engine/session_check_admin.php');
	
	if (isset($_POST['id_order']) ) :
	
		if (isset($_POST['toPay'])) {
			
			update_order_paid($connection,(int)$_POST['id_order']);
			
		}
		elseif (isset($_POST['toCancel'])) {
			
			update_order_cancel($connection,(int)$_POST['id_order']);
			
		}
		elseif (isset($_POST['toFinish'])) {
			
			update_order_finish($connection,(int)$_POST['id_order']);
			
		}
		
	endif;	

?> 