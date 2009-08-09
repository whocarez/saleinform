<?php
/* Инструменты грида 
 * $mode = 0 - режим грида, 1 - value picker
 * */
function get_tool($tool_name, $id, $mode = 0){
	$ci = &get_instance();
	switch($tool_name){
		case 'E':{
			return  $mode=='1'?
					anchor(get_currcontroller().'/vedit/'.$id.'/mrid/'.get_curririd(), img('public/img/icons/edit_inline.gif'), 'title="'.lang('EDIT_TOOL').'"'):
					anchor(get_currcontroller().'/edit/'.$id.'/mrid/'.get_curririd(), img('public/img/icons/edit_inline.gif'), 'title="'.lang('EDIT_TOOL').'"');
			break;
		}
		case 'D':{
			return  $mode=='1'?
					anchor(get_currcontroller().'/vdetails/'.$id.'/mrid/'.get_curririd(), img('public/img/icons/view_inline.gif'), 'title="'.lang('DETAILS_TOOL').'"'):
					anchor(get_currcontroller().'/details/'.$id.'/mrid/'.get_curririd(), img('public/img/icons/view_inline.gif'), 'title="'.lang('DETAILS_TOOL').'"');
			break;
		}
		case 'M':{
			return  $mode=='1'?
					anchor(get_currcontroller().'/vmove/'.$id.'/mrid/'.get_curririd(), img('public/img/icons/move_inline.gif'), 'title="'.lang('MOVE_TOOL').'"'):
					anchor(get_currcontroller().'/move/'.$id.'/mrid/'.get_curririd(), img('public/img/icons/move_inline.gif'), 'title="'.lang('MOVE_TOOL').'"');
			break;
		}
		
	}
	return null;
}
?>