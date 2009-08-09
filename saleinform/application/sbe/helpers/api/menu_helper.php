<?php
/* Рендеринг меню пользователя */
function get_menu(){
	$ci = &get_instance();
	return $ci->menu->render_menu();
}

/* RId текущего пункта меню */
function get_curririd(){
	$ci = &get_instance();
	return $ci->menu->get_curririd();
}

/* Контроллер текущего пункта меню */
function get_currcontroller(){
	$ci = &get_instance();
	return $ci->menu->get_currcontroller();
}

/* Rid меню по наименованию */
function get_irid_bycname($name){
	$ci = &get_instance();
	return $ci->menu->get_irid_bycname($name);
}


?>