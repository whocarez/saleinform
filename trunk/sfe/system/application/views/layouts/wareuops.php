<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title><?php echo $metatitle_area_obj?></title>
	<meta name="description" content="<?php echo $metadescription_area_obj?>">
	<meta name="keywords" content="<?php echo $keywords_area_obj?>">	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="SHORTCUT ICON" href="<?php echo base_url()?>images/si.png">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/boxes1.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/blocks2.css">
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
</head>
<body id="mainBody" style="text-align: center;">
<center>
	<div class="md" id="" style="">
		<!-- { Top header area  -->
		<div class="topMN">
			<div style="float: left;">
				<span id="aset">
				</span>
			</div>
			<div style="margin-left: 60%; text-align: right;">
			</div>
		</div>
		<!-- } Top header area  -->
		<div id="main_cnt">
			<table style="margin: 0pt; padding: 0pt; width: 100%; font-size: 100%;" border="0">
				<tbody>
					<tr>
						<td>
							<?php echo $search_bar_obj;?>
						</td>
					</tr>
				</tbody>
			</table>
<table style="margin: -3px 0pt 0pt; padding: 0pt; width: 100%; font-size: 100%;" border="0">
	<tbody>
		<tr>
			<td colspan="99">

				<!-- { Navline area -->
				<?php echo $navline_area_obj;?>				
				<!-- }  Navline area -->

			</td>
		</tr>
		<tr>
			<td id="left" width="170">

				<!-- { Login area -->
				<?php echo $login_area_obj;?>				
				<!-- } Login area -->

				<!-- { Quickmenu area -->
				<?php echo $quickmenu_area_obj;?>				
				<!-- } Quickmenu area -->
				
				<!--  { Linkchanges -->
				<?php echo $linkchanges_area_obj;?>
				<!--  { Linkchanges -->

				<!-- { Advertising -->
				<?php echo $googleads_left_obj;?>
				<!-- { Advertising -->
				
			</td>
		
<td class="cTD">

	<!-- { Categoeries -->
	<?php echo $wareuops_area_obj;?>
	<!-- } Categoeries -->
	
	<!-- { Advertising -->
	<?php echo $advertise_center_obj;?>		
	<!-- } Advertising -->		

	<!-- { Contactstoolbar area -->
	<?php echo $contactstoolbar_area_obj;?>		
	<!-- } Contactstoolbar area -->		

</td>
<td class="right" width="240">
	
	<!-- { Settings area -->
	<?php echo $settings_area_obj;?>
	<!-- } Settings area -->

	<!-- { Rating recomend area -->
	<?php echo $rating_recomend_obj;?>
	<!-- } Rating recomend area -->

	<!-- { Mostpopular area -->
	<?php echo $mostpopular_area_obj;?>
	<!-- } Mostpopular area -->

	<!-- { Advertising -->
	<?php echo $advertise_right_obj;?>
	<!-- { Advertising -->
</td>
</tr></tbody></table>
</div>
<div style="width: 100%; clear: both; text-align: center;">
	
<div class="topMenu" style="text-align: right; padding-right: 10px;">

	<!-- { Footer menu -->
	<?php echo $footermenu_area_obj;?>
	<!-- { Footer menu -->

<span id="footer_end" style="white-space: nowrap; height: 20px; line-height: 20px; font-size: 8pt;">
Copyright © 2006-2008 <a href="<?php echo base_url().index_page() ?>" class="c69" style="font-size: 100%;">Saleinform</a>&nbsp;&nbsp;All rights reserved
</span>
</div>

</div>
</div>

</center>
<div style="font-size: 80%;color:#D2D2D2;">
	Generation Time <?php echo $this->benchmark->elapsed_time(); ?> s. Memory Usage <? echo $this->benchmark->memory_usage();?>
</div>
<script type="text/javascript">_uacct = "UA-2175735-1";urchinTracker();</script> 
</body></html>