<?php
	ob_start();
	include_once("app.inc");
	global $g_BizSystem;
	$svcobj = $g_BizSystem->GetService('pricesService');
	$svcobj->runService();	
?>
