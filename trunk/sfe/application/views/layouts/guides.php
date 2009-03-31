<?=doctype('html4-strict')?>
<html>
<head>
	<title><?php echo $metatitle_area_obj?></title>
	<meta name="description" content="<?php echo $metadescription_area_obj?>">
	<meta name="keywords" content="<?php echo $keywords_area_obj?>">	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="SHORTCUT ICON" href="<?php echo base_url()?>images/si.png">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/settings.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/boxes1.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/blocks2.css">
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
</head>
<body>
	<?php echo $search_bar_obj;?>

	<table border="0" width="100%">
		<tr>
			<td colspan="3">
				<!-- { Navline area -->
				<?php echo $navline_area_obj;?>				
				<!-- }  Navline area -->
			</td>
		</tr>
		<tr>
			<td class="left">
				<!-- { Login area -->
				<?php echo $login_area_obj;?>				
				<!-- } Login area -->

				<!-- { Filters area -->
				<?php echo $filters_area_obj;?>				
				<!-- } Filters area -->
				
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
				<!-- { Guides -->
				<?php echo $guides_area_obj;?>
				<!-- } Guides -->
	
				<!-- { Advertising -->
				<?php echo $advertise_center_obj;?>		
				<!-- } Advertising -->		
	
				<!-- { Contactstoolbar area -->
				<?php echo $contactstoolbar_area_obj;?>		
				<!-- } Contactstoolbar area -->		
			
			</td>
			<td class="right">
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
	
				<!-- { Advertising -->
				<?php echo $googleads_right_obj;?>
				<!-- { Advertising -->
			</td>
		</tr>
	</table>


	<div class="footer">
		<div class="footer-left"></div>
		<div class="footer-right"></div>
		<!-- { Footer menu -->
		<div>
			<?php echo $footermenu_area_obj;?>
		</div>
		<!-- { Footer menu -->
	</div>

	<br>
	<div style="color:#D2D2D2;">
		<center>
			Generation Time <?php echo $this->benchmark->elapsed_time(); ?> s. Memory Usage <? echo $this->benchmark->memory_usage();?>
		</center>
	</div>

	<script type="text/javascript">_uacct = "UA-2175735-1";urchinTracker();</script> 
</body>
</html>