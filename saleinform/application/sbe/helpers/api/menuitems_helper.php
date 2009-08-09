<?php
function get_menuitems_list(){
	$ci = &get_instance();
	$ci->load->model('menuitems_model');
	$list = $ci->menuitems_model->get_list();
	$res = array(''=>$ci->config->item('crm_dropdown_empty'));
	foreach($list as $c) $res[$c->rid] = $c->item_name.($c->item_controller?('|<b>'.$c->item_controller).'</b>':'');
	return $res;
}
?>