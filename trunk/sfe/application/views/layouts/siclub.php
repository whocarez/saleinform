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
	<script type="text/javascript" src="<?php echo base_url()?>javascript/prototype.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>javascript/prototype_editclients.js"></script>
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
</head>
<body>
	<?php echo $search_bar_obj;?>

	<table border="0" width="100%">
		<tr>
			<td class="left">
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
				<!-- { Siclub area -->
				<?php echo $siclub_area_obj;?>
				<!-- } Siclub area -->
	
				<!-- { Advertising -->
				<?php echo $advertise_center_obj;?>		
				<!-- } Advertising -->	
		
				<!-- { Categoeries -->
				<?php echo $categories_table_obj;?>
				<!-- } Categoeries -->

				<!-- { Contactstoolbar area -->
				<?php echo $contactstoolbar_area_obj;?>		
				<!-- } Contactstoolbar area -->		
			
			</td>
			<td class="right">
				<!-- { Siclub login area -->
				<?php echo $siclub_loginarea_obj;?>
				<!-- { Siclub login area -->
	
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