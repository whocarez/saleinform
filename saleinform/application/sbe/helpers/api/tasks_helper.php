<?php
/* Список задач */
function get_tasks(){
	$ci = &get_instance();
	return $ci->taskslib->get_tasks();
}

/* Окрашиваем задачи
 * если просрочена - #FBE3E4
 * текущие - #E6EFC2
 * будущие - #FFFFFF
 * */
function get_task_bkg($date){
	if(date('Y-m-d')>date('Y-m-d', strtotime($date))) return '#FBE3E4';
	else if(date('Y-m-d')==date('Y-m-d', strtotime($date))) return '#E6EFC2';
	else return '#FFFFFF';
}
?>