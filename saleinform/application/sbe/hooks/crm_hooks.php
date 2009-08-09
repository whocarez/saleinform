<?php
function hook_profile_on(){
	$ci = &get_instance();
	return $ci->config->item('crm_profile_on')?$ci->output->enable_profiler(TRUE):$ci->output->enable_profiler(FALSE);
}

function hook_is_logged(){
	$ci = &get_instance();
	return $ci->user->is_logged();
}

function hook_init_user(){
	$ci = &get_instance();
	return $ci->user->init_user();
}

function hook_init_menu(){
	$ci = &get_instance();
	return $ci->menu->init_menu();
}

function hook_security_mitem(){
	$ci = &get_instance();
	if($ci->uri->segment(1)=='' || $ci->uri->segment(1)=='login'|| $ci->uri->segment(1)=='welcome') return;
	$segments_arr = $ci->uri->uri_to_assoc(2);
	if(!isset($segments_arr['mrid'])) show_error(lang('MENU_SECURITY_ERROR'));
	if(!$ci->menu->is_allowed($segments_arr['mrid'])) show_error(lang('MENU_SECURITY_ERROR'));  
	return $ci->menu->init_menu();
}
