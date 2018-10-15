<?
//формирование меню
function doMenu($list, $level=0){
	if ($level == 0) 
        $menu = '<ul id="menu">';

    foreach ($list as $key => $value){
        $submenu = '';
		
         if($value['id_group_parent'] == $level){
            $menu .= '<li>';
            $menu .= '<a href="?id_group=' . $key . '" title="' . $value['group_name'] . '">' . $value['group_name'] . '</a>';
                $submenu .=  doMenu($list, $value['id_group']); // запускаем подменю для данного id_group

            if($submenu != '') $menu .= '<ul class="submenu">' . $submenu . '</ul>';

            $menu .= '</li>';
            }
			
        }
       if ($level == 0)  $menu .= "</ul>";
       return $menu;
}
?>