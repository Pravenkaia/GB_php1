<?
//формирование меню групп товаров в админке
function doMenuGroupsAdmin($list, $level){
	if ($level == 0) 
        $menu = '<ul id="menu' .$level . '">';

    foreach ($list as $key => $value){
        $submenu = '';
         if($value['id_group_parent'] == $level){
            $menu .= '<li><div>';
            $menu .= '<input type="checkbox" name="id_group[]" value="' . $value['id_group'] . '" ';
			$menu .=  $value['checked'] ;
			$menu .= '> ID= ' . $value['id_group'] . ', ' . $value['group_name'];
                $submenu .=  doMenuGroupsAdmin($list, $value['id_group']); // запускаем подменю для данного id_group

            if($submenu != '') $menu .= '<ul class="submenu">' . $submenu . '</ul>';

            $menu .= '</div></li>';
            }
			
        }
       if ($level == 0)  $menu .= "</ul>";
       return $menu;
}

?>